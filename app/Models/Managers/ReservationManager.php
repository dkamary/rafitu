<?php

namespace App\Models\Managers;

use App\Models\Parameter;
use App\Models\Reservation;
use App\Models\ReviewHistory;
use App\Models\Ride;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public static function getReservationsFinished() : Collection {
        $results = DB::table('review_history')
            ->select(['reservation_id'])
            ->where('status', 'like', ReviewHistory::STATUS_SENT)
            ->get();

        $excludeReservations = [];
        foreach($results as $r) {
            $excludeReservations[] = (int)$r->reservation_id;
        }

        $results = DB::table('ride')
            ->select(['id'])
            ->where('arrival_date', '<', date('Y-m-d H:i:s'))
            ->get();

        $rideIds = [];
        foreach($results as $r) {
            $rideIds[] = (int)$r->id;
        }

        $finished = Reservation::whereIn('ride_id', $rideIds)
            ->whereNotIn('id', $excludeReservations)
            ->orderBy('reservation_date', 'asc')
            ->get();

        return $finished;
    }
}
