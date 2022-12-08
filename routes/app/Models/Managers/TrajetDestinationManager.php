<?php

namespace App\Models\Managers;

use App\Models\TrajetDestination;

class TrajetDestinationManager {
    /**
     * random element
     *
     * @return TrajetDestination[]|null
     */
    public static function random() : array {
        $array = [];
        $result = TrajetDestination::all();
        $destinations = [];
        foreach($result as $r) {
            $destinations[] = $r;
        }
        $indexes = array_rand($destinations, 3);
        foreach($indexes as $index) {
            $array[] = $destinations[$index];
        }

        return $array;
    }
}
