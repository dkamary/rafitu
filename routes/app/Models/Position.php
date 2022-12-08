<?php

namespace App\Models;

class Position {
    public $lng;
    public $lat;

    public function __construct(float $lat, float $lng)
    {
        $this->lng = $lng;
        $this->lat = $lat;
    }

    public function isset() : bool {
        if((int)$this->lat == 0 || (int)$this->lng == 0) return false;

        return true;
    }
}
