<?php

namespace App\Http\Controllers;

use App\Models\Managers\RideManager;
use App\Models\Position;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request) {
        $origin_lat = $request->input('origin_lat');
        $origin_lng = $request->input('origin_lng');

        $departure = new Position((float)$request->input('origin_lat'), (float)$request->input('origin_lng'));
        $arrival = new Position((float)$request->input('destination_lat'), (float)$request->input('destination_lng'));
        $date = $request->input('search_date');
        $passager = $request->input('search_count');

        $distance_cmp = 5; // 10 miles radius

        $rides = RideManager::search($departure, $arrival, $date, $passager, $distance_cmp);

        return view('pages.ride-search-result', $rides);
    }
}
