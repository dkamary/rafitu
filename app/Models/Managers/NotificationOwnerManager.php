<?php

namespace App\Models\Managers;

use App\Models\Managers\Interfaces\NotificationInterface;
use App\Models\NotificationParameter;
use App\Models\Reservation;
use App\Models\Ride;

class NotificationOwnerManager implements NotificationInterface {

    public static function newRide(Ride $ride) {
        $owner = $ride->getOwner();
        $email = $owner->email;

        $subject = 'Nouveau trajet ajouté';
        $content = view('templates.emails.owner.ride-new', [
            'ride' => $ride,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function newReservation(Reservation $reservation) {
        $ride = $reservation->getRide();
        $owner = $ride->getOwner();
        $email = $owner->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.owner.reservation-new', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function cancelReservation(Reservation $reservation) {
        $ride = $reservation->getRide();
        $owner = $ride->getOwner();
        $email = $owner->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.owner.reservation-cancel', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function payReservation(Reservation $reservation) {
        $ride = $reservation->getRide();
        $owner = $ride->getOwner();
        $email = $owner->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.owner.reservation-pay', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }
}
