<?php

namespace App\Models\Managers;

use Illuminate\Http\Request;

class ReservationManager {
    public static function getDataFromRequest(Request $request) : array {
        return [
            'ride_id' => (int)$request->input('ride_id'),
            'user_id' => (int)$request->input('user_id'),
            'price' => (float)$request->input('price'),
            'is_paid' => (float)$request->input('is_paid'),
            'reservation_date' => date('Y-m-d H:i:s'),
            'payment_date' => date('Y-m-d H:i:s'),
            'passenger' => (int)$request->input('passenger'),
        ];
    }
}