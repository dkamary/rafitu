<?php

namespace App\Models\Managers;

use App\Models\Position;
use App\Models\Ride;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RideManager {

    public static function create(array $data ) : ?Ride {
        self::sanitizeData($data);
        $ride = Ride::create($data);

        return $ride;
    }

    public static function search(Position $departure, Position $arrival, ?string $date = null, ?int $passager = null, int $distance = 10) : array {
        $rideIds = [];

        if($departure->isset()) {
            array_merge($rideIds, self::searchByPosition($departure, $distance));
        }

        if($arrival->isset()) {
            array_merge($rideIds, self::searchByPosition($arrival, $distance));
        }

        if($rideIds != []) {
            $rideIds = array_unique($rideIds);
        }

        $builder = Ride::where('ride_status_id', '=', 1);

        if(count($rideIds)) {
            $builder->whereIn('id', $rideIds);
        }

        if($passager > 0) {
            $builder->where('seats_available', '=', $passager);
        }

        $builder->orderBy('departure_date', 'ASC');

        if($date && $date != '') {
            $builder->where('departure_date', '>=', $date);
        }

        return [
            'rides' => $builder->get(),
            'count' => $builder->count(),
            'ids' => $rideIds,
            'parameters' => [
                'origin' => $departure,
                'destination' => $arrival,
                'date' => $date,
                'passagers' => $passager,
            ],
        ];

        $rides = [];
        foreach($rideIds as $id) {
            $ride = Ride::where('id', '=', $id)->first();
            if($ride) {
                $rides[] = $ride;
            }
        }

        return $rides;
    }

    private static function searchByPosition(Position $position, int $distance) : array {
        $sql = "SELECT
            *,
            ST_Distance_Sphere( point ({$position->lng}, {$position->lat}), point(lng, lat)) * .000621371192 AS `distance_in_miles`
        FROM `ride_itinerary`
        HAVING `distance_in_miles` <= $distance
        ORDER BY `distance_in_miles` ASC";

        $results = DB::select(DB::raw($sql));

        $rideIds = [];
        foreach($results as $data) {
            if(!isset($rideIds[$data->ride_id])) {
                $rideIds[$data->ride_id] = $data->ride_id;
            } else {
                continue;
            }
        }

        return $rideIds;
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
