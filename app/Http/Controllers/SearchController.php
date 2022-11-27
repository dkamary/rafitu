<?php

namespace App\Http\Controllers;

use App\Models\Managers\RideManager;
use App\Models\Position;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request) {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        $departure = new Position((float)$request->input('origin_lat'), (float)$request->input('origin_lng'));
        $arrival = new Position((float)$request->input('destination_lat'), (float)$request->input('destination_lng'));
        $date = $request->input('search_date');
        $passager = $request->input('search_count');

        $distance_cmp = 5; // 5 miles radius

        // dd([
        //     $origin,
        //     $destination,
        //     $departure,
        //     $arrival,
        //     $date,
        //     $passager,
        //     $distance_cmp
        // ]);

        $rides = RideManager::search(
            $origin,
            $destination,
            $departure,
            $arrival,
            $date,
            $passager,
            $distance_cmp);

        return view('pages.ride.search-result', $rides);
    }
}
