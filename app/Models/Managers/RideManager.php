<?php

namespace App\Models\Managers;

use App\Models\Position;
use App\Models\Ride;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RideManager
{

    public static function create(array $data): ?Ride
    {
        self::sanitizeData($data);
        $ride = Ride::create($data);

        return $ride;
    }

    public static function search(
        ?string $origin,
        ?string $destination,
        Position $departure,
        Position $arrival,
        ?string $date = null,
        ?int $passager = null,
        int $distance = 10
    ): array {
        $rideIds = [];
        $searchDone = false;
        $sql = [];
        $results = [];

        if(($origin || $departure->isset()) && ($destination || $arrival->isset())) {
            $searchDone = true;
            $positionSearch = self::searchByPositionByOriginDestination($departure, $arrival, $distance);
            $labelSearch = self::searchByLabelByOriginDestination($origin, $destination);
            $rideIds = array_merge($positionSearch['ids'], $labelSearch['ids']);
        } elseif ($origin || $departure->isset()) {
            $postionSearch = self::searchByDeparture($departure, $distance);

            $searchDone = true;
            $sql['position_search_departure'] = $postionSearch['sql'];
            $results['position_search_departure'] = $postionSearch['results'];

            $labelSearch = self::searchByDepartureLabel($origin);
            $sql['label_search_departure'] = $labelSearch['sql'];
            $results['label_search_departure'] = $labelSearch['results'];

            $rideIds = array_merge($rideIds, $postionSearch['ids'], $labelSearch['ids']);
        } elseif ($destination || $arrival->isset()) {
            $postionSearch = self::searchByArrival($arrival, $distance);

            $searchDone = true;
            $sql['arrival'] = $postionSearch['sql'];
            $results['arrival'] = $postionSearch['results'];

            $labelSearch = self::searchByArrivalLabel($destination);
            $sql['label_search_arrival'] = $labelSearch['sql'];
            $results['label_search_arrival'] = $labelSearch['results'];

            $rideIds = array_merge($rideIds, $postionSearch['ids'], $labelSearch['ids']);
        }

        if ($rideIds != []) {
            $rideIds = array_unique($rideIds);
        }

        if (count($rideIds) == 0 && $searchDone) {
            return [
                'rides' => [],
                'count' => 0,
                'ids' => $rideIds,
                'parameters' => [
                    'origin' => $departure,
                    'destination' => $arrival,
                    'date' => $date,
                    'passagers' => $passager,
                    'Messages' => 'Not Found! 404!!!',
                    'sql' => $sql,
                    'results' => $results,
                ],
            ];
        }

        $builder = Ride::where('ride_status_id', '=', 1);

        if (count($rideIds)) {
            $builder->whereIn('id', $rideIds);
        }

        if ($passager > 0) {
            $builder->where('seats_available', '=', $passager);
        }

        // $builder->orderBy('departure_date', 'ASC');

        if ($date && $date != '') {
            $builder->where('departure_date', '>=', $date)
                ->where('departure_date', '>=', 'now()');
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
                'origin_isset' => $departure->isset(),
                'destination_isset' => $arrival->isset(),
                'sql' => $sql,
                'results' => $results,
            ],
        ];

        $rides = [];
        foreach ($rideIds as $id) {
            $ride = Ride::where('id', '=', $id)->first();
            if ($ride) {
                $rides[] = $ride;
            }
        }

        return $rides;
    }

    public static function getRandom($count = 3) : ?Collection {
        $reservationsID = [];
        $result = DB::select('SELECT id FROM `ride` WHERE `departure_date` > NOW()');
        foreach($result as $r) {
            $reservationsID[] = (int)$r->id;
        }

        if(count($result) <= $count) {

            return Ride::whereIn('id', $reservationsID)->get();
        }
        $randomIds = array_rand($reservationsID, 3);

        return Ride::whereIn('id', $randomIds)->get();
    }

    private static function searchByPosition(string $fieldLong, string $fieldLat, Position $position, int $distance): array
    {
        $sql = "SELECT id, ST_Distance_Sphere( point ({$position->lng}, {$position->lat}), point($fieldLong, $fieldLat)) * .000621371192 AS `distance_in_miles`
        FROM `ride`
        HAVING `distance_in_miles` <= $distance
        ORDER BY `distance_in_miles` ASC";

        $results = DB::select(DB::raw($sql));

        $rideIds = [];
        foreach ($results as $data) {
            if (!isset($rideIds[$data->id])) {
                $rideIds[$data->id] = (int)$data->id;
            } else {
                continue;
            }
        }

        return [
            'ids' => $rideIds,
            'sql' => $sql,
            'results' => count($results),
        ];
    }

    private static function searchByPositionByOriginDestination(Position $origin, Position $destination, int $distance): array
    {
        $sql = "SELECT id,\n"
        ." ST_Distance_Sphere( point ({$origin->lng}, {$origin->lat}), point(`departure_position_long`, `departure_position_lat`)) * .000621371192 as `distance_origin`,\n"
        ." ST_Distance_Sphere( point ({$destination->lng}, {$destination->lat}), point(`arrival_position_long`, `arrival_position_lat`)) * .000621371192 as `distance_destination`\n"
        ." FROM `ride`\n"
        ." HAVING `distance_origin` <= $distance\n"
        ." AND `distance_destination` <= $distance\n"
        ;

        $results = DB::select(DB::raw($sql));

        $rideIds = [];
        foreach ($results as $data) {
            if (!isset($rideIds[$data->id])) {
                $rideIds[$data->id] = (int)$data->id;
            } else {
                continue;
            }
        }

        return [
            'ids' => $rideIds,
            'sql' => $sql,
            'results' => count($results),
        ];
    }

    private static function searchByDeparture(Position $position, int $distance): array
    {

        return self::searchByPosition('departure_position_long', 'departure_position_lat', $position, $distance);
    }

    private static function searchByDepartureLabel(?string $label = null): array
    {
        $ids = [];
        if (!$label) {
            return [
                'ids' => $ids,
                'label' => $label,
                'sql' => null,
                'message' => 'Label is empty',
            ];
        }

        $label = addslashes($label);
        $sql = "SELECT `id`, MATCH(`departure_label`) AGAINST('$label' IN NATURAL LANGUAGE MODE) as `score`"
            . " FROM `ride`"
            . " WHERE MATCH(`departure_label`) AGAINST('$label' IN NATURAL LANGUAGE MODE) > 0"
            . " AND `departure_date` >= NOW()"
            . " ORDER BY `score` DESC";
        $results = DB::select(DB::raw($sql));
        foreach ($results as $row) {
            if (isset($ids[$row->id])) continue;
            $ids[$row->id] = (int)$row->id;
        }

        return [
            'ids' => $ids,
            'sql' => $sql,
            'results' => $results,
        ];
    }

    private static function searchByArrival(Position $position, int $distance): array
    {

        return self::searchByPosition('arrival_position_long', 'arrival_position_lat', $position, $distance);
    }


    private static function searchByArrivalLabel(?string $label = null): array
    {
        $ids = [];
        if (!$label) {
            return [
                'ids' => $ids,
                'label' => $label,
                'sql' => null,
                'message' => 'Label is empty',
            ];
        }

        $label = addslashes($label);
        $sql = "SELECT `id`, MATCH(`arrival_label`) AGAINST('$label' IN NATURAL LANGUAGE MODE) as `score`"
            . " FROM `ride`"
            . " WHERE MATCH(`arrival_label`) AGAINST('$label' IN NATURAL LANGUAGE MODE) > 0"
            . " AND `arrival_date` >= NOW()"
            . " ORDER BY `score` DESC";
        $results = DB::select(DB::raw($sql));
        foreach ($results as $row) {
            if (isset($ids[$row->id])) continue;
            $ids[$row->id] = (int)$row->id;
        }

        return [
            'ids' => $ids,
            'sql' => $sql,
            'results' => $results,
        ];
    }

    private static function searchInItinerary(Position $position, int $distance): array
    {
        $sql = "SELECT `ride_id`, ST_Distance_Sphere( point ({$position->lng}, {$position->lat}), point(lng, lat)) * .000621371192 AS `distance_in_miles`"
            . " FROM `ride_itinerary`"
            . " HAVING `distance_in_miles` <= $distance"
            . " ORDER BY `distance_in_miles` ASC";

        $results = DB::select(DB::raw($sql));

        $rideIds = [];
        foreach ($results as $data) {
            if (!isset($rideIds[$data->ride_id])) {
                $rideIds[$data->ride_id] = (int)$data->ride_id;
            } else {
                continue;
            }
        }

        return [
            'ids' => $rideIds,
            'sql' => $sql,
            'results' => count($results),
        ];
    }

    private static function searchByLabelByOriginDestination(string $origin, string $destination) : array {
        $ids = [];
        if (!$origin) {
            return [
                'ids' => $ids,
                'label' => $origin,
                'sql' => null,
                'message' => 'Origin is empty',
            ];
        }
        if (!$destination) {
            return [
                'ids' => $ids,
                'label' => $destination,
                'sql' => null,
                'message' => 'Destination is empty',
            ];
        }

        $origin = addslashes($origin);
        $destination = addslashes($destination);
        $sql = "SELECT `id`,"
            . " MATCH(`departure_label`) AGAINST('$origin' IN NATURAL LANGUAGE MODE) as `score_departure`,"
            . " MATCH(`arrival_label`) AGAINST('$destination' IN NATURAL LANGUAGE MODE) as `score_arrival`"
            . " FROM `ride`"
            . " WHERE MATCH(`departure_label`) AGAINST('$origin' IN NATURAL LANGUAGE MODE) > 0"
            . " AND MATCH(`arrival_label`) AGAINST('$destination' IN NATURAL LANGUAGE MODE) > 0"
            // . " AND `arrival_date` >= NOW()"
            . " ORDER BY `score_departure` DESC, `score_arrival` DESC";
        $results = DB::select(DB::raw($sql));
        foreach ($results as $row) {
            if (isset($ids[$row->id])) continue;
            $ids[$row->id] = (int)$row->id;
        }

        return [
            'ids' => $ids,
            'sql' => $sql,
            'results' => $results,
        ];
    }

    private static function sanitizeData(array &$data): void
    {
        $data['owner_id'] = $data['owner_id'] ?? null;
        $data['vehicle_id'] = $data['vehicle_id'] ?? null;
        $data['driver_id'] = $data['driver_id'] ?? null;
        $data['departure_date'] = $data['departure_date'] ?? null;
        $data['departure_position_long'] = $data['departure_position_long'] ?? null;
        $data['departure_position_lat'] = $data['departure_position_lat'] ?? null;
        $data['arrival_date'] = $data['arrival_date'] ?? null;
        $data['arrival_position_long'] = $data['arrival_position_long'] ?? null;
        $data['arrival_position_lat'] = $data['arrival_position_lat'] ?? null;
        $data['seats_available'] = $data['seats_available'] ?? null;
        $data['woman_only'] = $data['woman_only'] ?? null;
        $data['price'] = $data['price'] ?? 0.0;
        $data['ride_status_id'] = $data['ride_status_id'] ?? null;
    }
}
