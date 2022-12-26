<?php

namespace App\Http\Controllers;

use App\Models\Managers\ParamManager;
use App\Models\Managers\RideManager;
use App\Models\Position;
use App\Models\Ride;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SearchController extends Controller {

    public function search(Request $request) {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        $departure = new Position((float)$request->input('origin_lat'), (float)$request->input('origin_lng'));
        $arrival = new Position((float)$request->input('destination_lat'), (float)$request->input('destination_lng'));
        $date = $request->input('search_date');
        $passager = $request->input('search_count');

        $distance_cmp = 5; // 5 miles radius

        $rides = RideManager::search(
            $origin,
            $destination,
            $departure,
            $arrival,
            $date,
            $passager,
            $distance_cmp);

        session()->put('departure', $departure);
        session()->put('arrival', $arrival);
        session()->save();

        return view('pages.ride.search-result', $rides);
    }

    public function match(Request $request) : RedirectResponse {
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $passager = (int)$request->input('passager');
        $arrival_address = $request->input('arrival_address');
        $departure_address = $request->input('departure_address');
        $departure_date = $request->input('departure_date');
        $time = $request->input('time');

        $departure = new Position((float)$request->input('origin_lat'), (float)$request->input('origin_lng'));
        $arrival = new Position((float)$request->input('destination_lat'), (float)$request->input('destination_lng'));

        $date = $departure_date ? new DateTime($departure_date.' ' .$time) : null;

        $results = RideManager::search(
            $departure_address,
            $arrival_address,
            $departure,
            $arrival,
            $date ? $date->format('Y-m-d H:i') : null,
            $passager,
            100
        );

        session()->put('sql', $results['parameters']['sql']);
        session()->put('ride_match', $results['ids']);
        session()->save();

        return response()->redirectToRoute('ride_match_result');

        // $sql = 'SELECT id FROM `ride` WHERE `departure_date` > "' . date('Y-m-d') . '"';

        // // PASSAGER
        // if($passager > 0) {
        //     $sql .= ' AND `seats_available` >= ' . $passager;
        // }

        // // ADDRESS D'ARRIVEE
        // if(strlen(trim($arrival_address)) > 0) {
        //     $arrival_address = trim($arrival_address);
        //     $words = explode(' ', $arrival_address);

        //     $sql .= ' AND (';
        //     $sql .= ' `arrival_label` LIKE "%' . addslashes($arrival_address) .'%"';

        //     if(count($words) > 1) {
        //         foreach($words as $w) {
        //             $sql .= ' OR `arrival_label` LIKE "%' .$w . '%"';
        //         }
        //     }

        //     $sql .= ')';
        // }

        // // ADRESSE DE DEPART
        // if(strlen(trim($departure_address)) > 0) {
        //     $departure_address = trim($departure_address);
        //     $words = explode(' ', $departure_address);

        //     $sql .= ' AND (';
        //     $sql .= ' `departure_label` LIKE "%' . addslashes($departure_address) .'%"';

        //     if(count($words) > 1) {
        //         foreach($words as $w) {
        //             $sql .= ' OR `departure_label` LIKE "%' .$w . '%"';
        //         }
        //     }

        //     $sql .= ')';
        // }

        // // DATE ET HEURE
        // if($departure_date && $time) {
        //     $datetime = trim(($departure_date ?: '') .' ' .($time ?: ''));
        //     $sql .= ' AND DATE(`departure_date`) = DATE("' .$datetime .'")';
        //     $sql .= ' AND TIME(`departure_date`) = TIME("' .$datetime .'")';
        // } elseif($departure_date) {
        //     $sql .= ' AND DATE(`departure_date`) = "' .$departure_date .'"';
        // } elseif($time) {
        //     $sql .= ' AND TIME(`departure_date`) = "' .$time .'"';
        // }

        // // dd($sql);

        // $rideMatchId = DB::select($sql);
        // $ids = [];
        // foreach($rideMatchId as $r) {
        //     $ids[] = (int)$r->id;
        // }

        // session()->put('sql', $sql);
        // session()->put('ride_match', $ids);
        // session()->save();

        // return response()->redirectToRoute('ride_match_result');
    }

    public function matchResult() : View {
        $ids = session()->get('ride_match', []);
        $rides = Ride::whereIn('id', $ids)->get();

        // dd($rides);

        $count = count($rides);
        $title = sprintf('%d trajet%s correspondant%s', $count, $count > 1 ? 's' : '', $count > 1 ? 's' : '');

        return view('pages.ride.match', [
            'rides' => $rides,
            'title' => $title,
            'count' => $count,
            'sql' => session()->get('sql'),
        ]);
    }
}
