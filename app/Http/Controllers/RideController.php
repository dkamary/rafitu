<?php

namespace App\Http\Controllers;

use App\Models\Managers\NotificationManager;
use App\Models\Managers\ParamManager;
use App\Models\Managers\RecurrenceManager;
use App\Models\Managers\RideManager;
use App\Models\Position;
use App\Models\Ride;
use App\Models\RideItinerary;
use App\Models\RideRecurrence;
use App\Models\RideStatus;
use App\Models\User;
use App\Models\Vehicule;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RideController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('');
    }

    public function add() {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $vehicules = Vehicule::where('owner_id', '=', $user->id)->get();

        if($user->identification_scan || $user->licence_scan || $user->insurrance_scan) {

            return view('pages.ride.add', [
                'vehicules' => $vehicules
            ]);
        }

        if(!$user->isVerified()) {

            return response()->redirectToRoute('driver_verification');
        }

        return view('pages.ride.add', [
            'vehicules' => $vehicules,
        ]);
    }

    public function save(Request $request) : RedirectResponse {
        $user = Auth::user();
        $status = RideStatus::where('id', '=', 1)->first();
        if(!$status) {
            $status = RideStatus::create([
                'label' => 'Planifié',
                'is_active' => 1,
            ]);
        }

        $data = [
            'owner_id' => $user->id,
            'driver_id' => $user->id,
            'vehicle_id' => $request->input('vehicule_id'),
            'label' => 'ride-' . uniqid(),
            'departure_label' => $request->input('departure_label'),
            'departure_date' => $request->input('departure_date'),
            'departure_position_long' => $request->input('departure_lng'),
            'departure_position_lat' => $request->input('departure_lat'),
            'arrival_label' => $request->input('arrival_label'),
            'arrival_date' => $request->input('arrival_date'),
            'arrival_position_long' => $request->input('arrival_lng'),
            'arrival_position_lat' => $request->input('arrival_lat'),
            'seats_available' => $request->input('seats_available'),
            'woman_only' => $request->input('woman_only') == 'on' ? 1 : 0,
            'price' => (float)$request->input('price'),
            'ride_status_id' => $status->id,
            'distance' => (int)$request->input('distance'),
            'smokers' => $request->input('smokers') == 'on' ? 1 : 0,
            'animals' => $request->input('animals') == 'on' ? 1 : 0,
            'has_recurrence' => $request->input('recurrence') == 'yes' ? 1 : 0,
            'duration' => $request->input('duration'),
        ];

        $parameters = ParamManager::getParameters();
        $commission = $data['has_recurrence'] == 1 ? (float)$parameters->com_quotidien : (float)$parameters->com_longtrajet;
        $data['price'] = $data['price'] * (1 + ($commission / 100));
        $arrivalDate = new DateTime();
        $arrivalDate->modify('+' . $request->input('duration') . ' seconds');
        $data['arrival_date'] = $arrivalDate->format('Y-m-d H:i:s');

        $ride = Ride::create($data);
        $rideID = (int)$ride->id;

        // Ride Recurrence
        if($request->input('recurrence') == 'yes') {
            // dump('recurrence');
            $recurrence = RideRecurrence::create([
                'ride_id' => $rideID,
                'lundi' => $request->input('lundi-check') == 'on',
                'mardi' => $request->input('mardi-check') == 'on',
                'mercredi' => $request->input('mercredi-check') == 'on',
                'jeudi' => $request->input('jeudi-check') == 'on',
                'vendredi' => $request->input('vendredi-check') == 'on',
                'samedi' => $request->input('samedi-check') == 'on',
                'dimanche' => $request->input('dimanche-check') == 'on',
                'until' => $request->input('date-end'),
            ]);

            RecurrenceManager::buildRecurrence($recurrence);
        }

        // Create Itinerary
        $itineraries = $request->input('itinerary');
        $dataItinerary = [];
        foreach($itineraries as $it) {
            list($lat, $lng) = explode(', ', $it);
            $dataItinerary[] = [
                'ride_id' => $rideID,
                'lat' => $lat,
                'lng' => $lng,
            ];
        }

        RideItinerary::insert($dataItinerary);

        NotificationManager::adminNewRide($ride);

        return response()->redirectToRoute('ride_complete', ['ride' => $ride]);
    }

    public function complete(Ride $ride) {
        $this->middleware('auth');

        return view('trajet.creation-termine', [
            'ride' => $ride,
        ]);
    }

    public function list() : View {
        $rides = Ride::where('owner_id', '>', 0)
            ->orderBy('departure_date', 'desc')
            ->get();

        return view('trajet.liste', [
            'rides' => $rides
        ]);
    }

    public function show(Ride $ride) : View {
        $origin = session()->get('departure', new Position(0, 0));
        $destination = session()->get('arrival', new Position(0, 0));
        $distances = [
            $ride->id => (object)[
                'id' => $ride->id,
                'origin' => RideManager::getDistance(new Position($ride->departure_position_lat, $ride->departure_position_long), $origin),
                'destination' => RideManager::getDistance(new Position($ride->arrival_position_lat, $ride->arrival_position_long), $destination),
            ],
        ];

        return view('trajet.details', [
            'ride' => $ride,
            'parameters' => [
                'origin' => $origin,
                'destination' => $destination,
            ],
            'distances' => $distances,
        ]);

        return view('pages.ride.show', [
            'ride' => $ride,
            'parameters' => [
                'origin' => $origin,
                'destination' => $destination,
            ],
            'distances' => $distances,
        ]);
    }

    public function detailsDepart(Ride $ride) : View {

        return view('trajet.point-details', [
            'ride' => $ride,
            'title' => $ride->departure_label,
            'centerLat' => $ride->departure_position_lat,
            'centerLng' => $ride->departure_position_long,
        ]);
    }

    public function detailsArrivee(Ride $ride) : View {

        return view('trajet.point-details', [
            'ride' => $ride,
            'title' => $ride->arrival_departure,
            'centerLat' => $ride->arrival_position_lat,
            'centerLng' => $ride->arrival_position_long,
        ]);
    }

    public function detailsChauffeur(Ride $ride) : View {

        return view('trajet.chauffeur-details', [
            'ride' => $ride,
        ]);
    }
}
