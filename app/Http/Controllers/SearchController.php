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
            5
        );

        session()->put('sql', $results['parameters']['sql']);
        session()->put('ride_match', $results['ids']);
        session()->save();

        return response()->redirectToRoute('ride_match_result');
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
