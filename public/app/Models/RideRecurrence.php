<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RideRecurrence extends Model
{
    protected $table = 'ride_recurrence';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ride_id',
        'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche',
        'until',
    ];
    public $timestamps = false;

    protected $ride;

    public function getRide() : Ride {
        if($this->ride) return $this->ride;

        return $this->ride = Ride::where('id', '=', (int)$this->ride_id)->first();
    }

    public function getWeekDays() : array {

        return [
            'lundi' => $this->lundi == 1,
            'mardi' => $this->mardi == 1,
            'mercredi' => $this->mercredi == 1,
            'jeudi' => $this->jeudi == 1,
            'vendredi' => $this->vendredi == 1,
            'samedi' => $this->samedi == 1,
            'dimanche' => $this->dimanche == 1,
        ];
    }

    public function getDateEnd() : DateTime {
        return new DateTime($this->until);
    }
}
