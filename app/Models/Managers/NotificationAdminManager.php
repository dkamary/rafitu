<?php

namespace App\Models\Managers;

use App\Models\Managers\Interfaces\NotificationInterface;
use App\Models\Reservation;
use App\Models\Ride;

class NotificationAdminManager implements NotificationInterface {

    public static function newRide(Ride $ride) {
        $subject = 'Nouveau trajet ajouté';
        $content = view('templates.emails.admin-ride-new', [
            'ride' => $ride,
        ])->render();

        NotificationManager::sendEmail(config('rafitu.admin'), $subject, $content);
    }

    public static function newReservation(Reservation $reservation) {
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin-reservation-new', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail(config('rafitu.admin'), $subject, $content);
    }

    public static function cancelReservation(Reservation $reservation)
    {
        //
    }

    public static function payReservation(Reservation $reservation)
    {
        //
    }
}
