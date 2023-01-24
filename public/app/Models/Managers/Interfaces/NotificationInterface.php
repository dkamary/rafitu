<?php

namespace App\Models\Managers\Interfaces;

use App\Models\Reservation;
use App\Models\Ride;

interface NotificationInterface {

    public static function newRide(Ride $ride);

    public static function newReservation(Reservation $reservation);

    public static function cancelReservation(Reservation $reservation);

    public static function payReservation(Reservation $reservation);
}
