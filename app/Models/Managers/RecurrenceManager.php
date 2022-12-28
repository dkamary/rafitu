<?php

namespace App\Models\Managers;

use App\Models\Ride;
use App\Models\RideRecurrence;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class RecurrenceManager {

    public static function buildRecurrence(RideRecurrence $rideRecurrence) : array {
        $rideData = [];
        $ride = $rideRecurrence->getRide();
        if(!$ride) {
            throw new Exception('Il n\'y a pas de trajet associé!');
        }

        $arrivalDate = $ride->getDateArrival();
        $cursorDate = clone $arrivalDate;
        $days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi',];
        $weekdays = $rideRecurrence->getWeekDays();
        $dateEnd = $rideRecurrence->getDateEnd();

        do {
            $cursorDate->modify('+1 day');

            $dayNumber = $cursorDate->format('w');
            $day = $days[$dayNumber] ?? -99;

            if(isset($weekdays[$day]) && $weekdays[$day] == true) {
                $rideData[] = self::createRide($ride, $cursorDate);
            }

        } while($cursorDate->getTimestamp() < $dateEnd->getTimestamp());

        // dump($rideData);

        DB::table('ride')->insert($rideData);

        return $rideData;
    }

    public static function createRide(Ride $ride, DateTime $date) : array {
        $data = $ride->getAttributes();
        if(isset($data['id'])) unset($data['id']);
        $data['departure_date'] = $date->format('Y-m-d H:i:s');
        $date->modify('+' . $ride->duration . ' seconds');
        $data['arrival_date'] = $date->format('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = null;
        // $newRide = Ride::create($data);

        return $data;
    }
}
