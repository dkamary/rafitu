<?php

namespace App\Http\Controllers;

use App\Models\Managers\RideManager;
use App\Models\Position;
use App\Models\Ride;
use App\Models\RideItinerary;
use App\Models\RideRecurrence;
use App\Models\RideStatus;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RideController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
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
            'vehicules' => $vehicules
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
        ];

        // dd([
        //     'post' => $_POST,
        //     'request' => $request,
        //     'data' => $data,
        //     'recurrence' => [
        //         'recurrence' => $request->post('recurrence'),
        //         'lundi' => $request->input('lundi-check') == 'on',
        //         'mardi' => $request->input('mardi-check') == 'on',
        //         'mercredi' => $request->input('mercredi-check') == 'on',
        //         'jeudi' => $request->input('jeudi-check') == 'on',
        //         'vendredi' => $request->input('vendredi-check') == 'on',
        //         'samedi' => $request->input('samedi-check') == 'on',
        //         'dimanche' => $request->input('dimanche-check') == 'on',
        //     ],
        // ]);

        $ride = Ride::create($data);
        $rideID = (int)$ride->id;

        // Ride Recurrence
        if($request->input('reccurrence') == 'yes') {
            $recurrence = RideRecurrence::create([
                'ride_id' => $rideID,
                'lundi' => $request->input('lundi-check') == 'on',
                'mardi' => $request->input('mardi-check') == 'on',
                'mercredi' => $request->input('mercredi-check') == 'on',
                'jeudi' => $request->input('jeudi-check') == 'on',
                'vendredi' => $request->input('vendredi-check') == 'on',
                'samedi' => $request->input('samedi-check') == 'on',
                'dimanche' => $request->input('dimanche-check') == 'on',
            ]);
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

        return response()->redirectToRoute('ride_complete', ['ride' => $ride]);
    }

    public function complete(Ride $ride) {

        return view('pages.ride.added', [
            'ride' => $ride,
        ]);
    }

    public function list() : View {
        $rides = Ride::all();

        return view('pages.ride.list', [
            'rides' => $rides,
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

        return view('pages.ride.show', [
            'ride' => $ride,
            'parameters' => [
                'origin' => $origin,
                'destination' => $destination,
            ],
            'distances' => $distances,
        ]);
    }
}
