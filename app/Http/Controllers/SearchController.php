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
        // dd($request);

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

        $builder = Ride::where('ride_status_id', '=', 1);
        $resultatDeRecherche = $builder->where('departure_label', 'LIKE', $departure_address)
            ->where('arrival_label', 'LIKE', $arrival_address)
            ->orderBy('departure_date', 'ASC')
            ->get();

        if(!$resultatDeRecherche->count()) {
            session()->put('sql', $builder->toSql());
            session()->put('ride_match', []);
            session()->put('trajet', null);
            session()->put('passenger', (int)$passager);
            session()->save();

            // dump($resultatDeRecherche);
            // dump(session()->get('ride_match'));

            return response()->redirectToRoute('ride_match_result');
        }

        $trajetIdeal = null;
        $suggestions = [];
        $date = null;
        if(!is_null($departure_date)) {
            $date = new DateTime($departure_date . ($time ? ' ' . $time : ''));
        }

        foreach($resultatDeRecherche as $trajet) {
            $disponible = $trajet->getSeatsAvailable();
            if($disponible <= 0) continue;

            if($disponible >= $passager) {
                $trajetDepartDate = new DateTime($trajet->departure_date);
                $diff = $date->diff($trajetDepartDate);
                if($diff->d == 0 && $diff->h == 0 && $diff->i == 0) {
                    $trajetIdeal = $trajet->id;

                    break;
                }
            } else {
                $suggestions[] = $trajet->id;
            }
        }

        session()->put('sql', $builder->toSql());
        session()->put('ride_match', $suggestions);
        session()->put('trajet', $trajetIdeal);
        session()->put('passenger', (int)$passager);
        session()->save();

        // dd(session());

        return response()->redirectToRoute('ride_match_result');
    }

    public function match_old(Request $request) : RedirectResponse {
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
        // dd(session()->get('ride_match'));

        $ids = session()->get('ride_match', []);
        $rides = Ride::whereIn('id', $ids)->get();
        $theRide = Ride::where('id', '=', (int)session()->get('trajet', null))->first();

        // dd($rides);

        $count = count($rides);
        $title = sprintf('%d trajet%s correspondant%s', $count, $count > 1 ? 's' : '', $count > 1 ? 's' : '');

        return view('pages.ride.match', [
            'rides' => $rides,
            'title' => $title,
            'count' => $count,
            'sql' => session()->get('sql'),
            'theRide' => $theRide,
            'passenger' => (int)session()->get('passenger', 1),
        ]);
    }
}
