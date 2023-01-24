<?php

namespace App\Http\Controllers;

use App\Models\Managers\CronManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CronController extends Controller
{
    public function commissions() : JsonResponse {
        $result = CronManager::commissions();

        return response()->json([
            'status' => $result->getStatusText(),
            'message' => $result->getMessage(),
            'data' => $result->getData(),
        ]);
    }

    public function reviews() : JsonResponse {
        $result = CronManager::reviews();

        return response()->json([
            'status' => $result->getStatusText(),
            'message' => $result->getMessage(),
            'data' => $result->getData(),
        ]);
    }
}
