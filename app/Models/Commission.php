<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commission';
    protected $primaryKey = 'id';
    protected $fillable = ['ride_id', 'reservation_id', 'amount', 'percent', 'label', 'created_at', 'payed_at', 'status'];
    public $timestamps = false;

    protected $reservation;
    protected $ride;
    protected $owner;

    public function isPaid() : bool {
        return $this->status == 'PAID';
    }

    public function getRide() : ?Ride {
        if($this->ride) return $this->ride;

        $this->ride = Ride::where('id', '=', (int)$this->ride_id)->first();

        if($this->ride) return $this->ride;

        if(!$this->reservation) {
            $this->reservation = $this->getReservation();
        }

        if(!$this->reservation) {
            return null;
        } else {
            $this->ride = $this->reservation->getRide();

            return $this->ride;
        }
    }

    public function getReservation() : ?Reservation {
        if($this->reservation) return $this->reservation;

        return $this->reservation = Reservation::where('id', '=', (int)$this->reservation_id)->first();
    }

    public function getOwner() : User {
        if($this->owner) return $this->owner;

        $reservation = $this->getReservation();
        if(!$reservation) return null;

        return $this->owner = $reservation->getuser();
    }
}
