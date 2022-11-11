<?php

namespace App\Models\Managers;

use App\Models\Ride;

class RideManager {

    public static function create(array $data ) : ?Ride {
        self::sanitizeData($data);
        $ride = Ride::create($data);

        return $ride;
    }

    private static function sanitizeData(array &$data) : void {
        $data['owner_id'] = $data['owner_id'] ?? null;
        $data['vehicle_id'] = $data['vehicle_id'] ?? null;
        $data['driver_id']= $data['driver_id'] ?? null;
        $data['departure_date'] = $data['departure_date'] ?? null;
        $data['departure_position_long'] = $data['departure_position_long'] ?? null;
        $data['departure_position_lat'] = $data['departure_position_lat'] ?? null;
        $data['arrival_date'] = $data['arrival_date'] ?? null;
        $data['arrival_position_long'] = $data['arrival_position_long'] ?? null;
        $data['arrival_position_lat'] = $data['arrival_position_lat'] ?? null;
        $data['seats_available'] = $data['seats_available'] ?? null;
        $data['woman_only'] = $data['woman_only'] ?? null;
        $data['price']= $data['price'] ?? 0.0;
        $data['ride_status_id']= $data['ride_status_id'] ?? null;
    }
}
