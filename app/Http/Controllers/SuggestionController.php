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
        $suggestions = [];
        foreach($trajets as $ride) {
            $suggestions[] = $ride;
        }

        return response()->json([
            'suggestions' => $suggestions,
        ]);
    }

    public function ville(Request $request) : JsonResponse {
        $cities = [];
        $search = $request->input('search');
        $count = $request->input('count', 10);
        $cities = SearchCityManager::searchCityOptimized($search, $count, ['CI', 'FR']);
        $suggestions = [];
        foreach($cities as $city) {
            $suggestions[] = $city;
        }

        return response()->json([
            'suggestions' => $suggestions,
        ]);
    }
}
