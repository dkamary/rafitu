<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ride_id', 'user_id', 'passenger', 'price', 'is_paid', 'reservation_date', 'payment_date',
    ];
    public $timestamps = false;

    protected $ride;
    protected $user;

    public function getuser() : ?User {
        return ($this->user) ?: $this->user = User::where('id', '=', (int)$this->user_id)->first();
    }

    public function hasUser() : bool {
        return is_null($this->user) ? false : true;
    }

    public function getRide() : ?Ride {
        return ($this->ride) ?: $this->ride = Ride::where('id', '=', (int)$this->ride_id)->first();
    }

    public function isPaid() : bool {
        return ($this->is_paid == 1);
    }

    public function getReservationDate(?string $format = null) {
        $date = new DateTime($this->reservation_date);

        return !$format ? $date : $date->format($format);
    }

    public function getPaymentDate(?string $format = null) {
        $date = new DateTime($this->payment_date);

        return !$format ? $date : $date->format($format);
    }
}
