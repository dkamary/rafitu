<?php

namespace App\Models\Managers;

use App\Models\Parameter;
use App\Models\Reservation;
use App\Models\Ride;
use Exception;
use Illuminate\Http\Request;

class ReservationManager {
    public static function getDataFromRequest(Request $request) : array {
        $ride = Ride::where('id', '=', (int)$request->input('ride_id'))->first();
        if(!$ride) {
            throw new Exception("La récupération du trajet depuis la base de données a échoué !");
        }

        $parameters = ParamManager::getParameters();
        $commission = $ride->isRecurrent() ? $parameters->com_quotidien : $parameters->com_longtrajet;
        $commissionType = $ride->isRecurrent() ? Parameter::COMMISSION_TRAJET_QUOTIDIEN : Parameter::COMMISSION_LONG_TRAJET;

        return [
            'ride_id' => (int)$request->input('ride_id'),
            'user_id' => (int)$request->input('user_id'),
            'price' => (float)$request->input('price'),
            'is_paid' => (float)$request->input('is_paid'),
            'reservation_date' => date('Y-m-d H:i:s'),
            'payment_date' => date('Y-m-d H:i:s'),
            'passenger' => (int)$request->input('passenger'),
            'commission' => $commission,
            'commission_type' => $commissionType,
            'status' => Reservation::STATUS_UNPAID,
        ];
    }
}
