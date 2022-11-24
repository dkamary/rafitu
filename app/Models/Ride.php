<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = 'ride';
    protected $primaryKey = 'id';
    protected $fillable = [
        'owner_id', 'vehicle_id', 'driver_id',
        'departure_label', 'departure_date', 'departure_position_long', 'departure_position_lat',
        'arrival_label', 'arrival_date', 'arrival_position_long', 'arrival_position_lat',
        'seats_available', 'woman_only', 'price',
        'ride_status_id', 'distance',
        'created_at', 'updated_at',
    ];
    public $timestamps = false;
    protected $status = null;
    protected $owner = null;
    protected $vehicule = null;
    protected $driver = null;
    protected $itineraries = null;

    public function getItineraries() {
        return ($this->itineraries) ?: $this->itineraries = RideItinerary::where('ride_id', '=', (int)$this->id)->get();
    }

    public function getDriver() : ?User {
        return ($this->driver) ?: $this->driver = User::where('id', '=', (int)$this->driver_id)->first();
    }

    public function getVehicule() : ?Vehicle {
        return ($this->vehicule) ?: $this->vehicule = Vehicle::where('id', '=', (int)$this->vehicle_id)->first();
    }

    public function getOwner() : ?User {
        if($this->owner) return $this->owner;

        $this->owner = User::where('id', '=', (int)$this->owner_id)->first();

        return $this->owner;
    }

    public function getStatus() : ?RideStatus {
        if($this->status) return $this->status;

        $this->status = RideStatus::where('id', '=', (int)$this->ride_status_id)->first();
        
        return $this->status;
    }

    public function getDistance(string $unit = 'km', int $precision= 2) : string {
        $units = [
            'km' => 1000,
            'm' => 1,
        ];

        return number_format((int)$this->distance / ($units[$unit] ?? 1), $precision, ' ', '.') . ' ' .$unit;
    }

    public function hasDepartureDate() : bool {
        return $this->hasDate($this->departure_date);
    }

    public function hasArrivalDate() : bool {
        return $this->hasDate($this->arrival_date);
    }

    public function getDepartureDate(string $format = 'd/m/Y H:i') : string {
        if(is_null($this->departure_date) || $this->departure_date == '') return '';

        return $this->getDate($this->departure_date, $format);
    }

    public function getArrivalDate(string $format = 'd/m/Y H:i') : string {
        if(is_null($this->arrival_date) || $this->arrival_date == '') return '';

        return $this->getDate($this->arrival_date, $format);
    }

    public function getDateDeparture() : DateTime {
        return new DateTime($this->departure_date);
    }

    public function getDateArrival() : DateTime {
        return new DateTime($this->arrival_date);
    }

    private function hasDate($date) : bool {
        if(is_null($date) || trim(strlen($date)) < 10) return false;

        return true;
    }

    private function getDate(string $date, string $format) : string {
        $datetime= new DateTime($date);

        return $datetime->format($format);
    }
}
