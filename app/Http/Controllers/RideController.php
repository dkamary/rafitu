<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Vehicule;
use Illuminate\View\View;
use App\Models\RideStatus;
use Illuminate\Http\Request;
use App\Models\RideItinerary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RideController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('');
    }

    public function add() {
        $user = Auth::user();
        $vehicules = Vehicule::where('owner_id', '=', $user->id)->get();

        return view('pages.ride-add', [
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
        ];

        // dd($data);

        $ride = Ride::create($data);
        $rideID = (int)$ride->id;

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

        return view('pages.ride-added', [
            'ride' => $ride,
        ]);
    }

    public function search(Request $request) {
        $origin_lat = $request->input('origin_lat');
        $origin_lng = $request->input('origin_lng');

        $distance_cmp = 5; // 10 miles radius

        $sql_origin = "SELECT
            *,
            ST_Distance_Sphere( point ($origin_lng, $origin_lat), point(lng, lat)) * .000621371192 AS `distance_in_miles`
        FROM `ride_itinerary`
        HAVING `distance_in_miles` <= $distance_cmp
        ORDER BY `distance_in_miles` ASC";

        $results = DB::select(DB::raw($sql_origin));

        $rideIds = [];
        foreach($results as $data) {
            if(!isset($rideIds[$data->ride_id])) {
                $rideIds[$data->ride_id] = $data->ride_id;
            } else {
                continue;
            }
        }
        $rides = [];
        foreach($rideIds as $id) {
            $ride = Ride::where('id', '=', $id)->first();
            if($ride) {
                $rides[] = $ride;
            }
        }

        return view('pages.ride-search-result', [
            'results' => $results,
            'sql' => $sql_origin,
            'origin' => [
                'lat' => $origin_lat,
                'lng' => $origin_lng,
            ],
            'rides' => $rides,
            'ids' => $rideIds,
        ]);
    }
}
