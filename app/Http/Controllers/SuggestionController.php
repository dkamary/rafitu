<?php

namespace App\Http\Controllers;

use App\Models\Managers\SearchCityManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function trajet(Request $request) : JsonResponse {
        $trajets = [];
        $search = $request->input('search');
        $count = $request->input('count', 10);
        $field = $request->input('field');
        $trajets = SearchCityManager::searchRide($search, $count, $field);

        return response()->json([
            'suggestions' => $trajets,
        ]);
    }

    public function ville(Request $request) : JsonResponse {
        $trajets = [];
        $search = $request->input('search');
        $count = $request->input('count', 10);
        $cities = SearchCityManager::searchCity($search, $count, 'city2');

        return response()->json([
            'suggestions' => $cities,
        ]);
    }
}
