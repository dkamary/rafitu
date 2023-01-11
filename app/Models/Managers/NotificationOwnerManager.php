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
        NotificationManager::createNotificationInfo($owner->id, $subject, $ride->toString(), route('ride_show', ['ride' => $ride->id]));
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
        NotificationManager::createNotificationInfo($owner->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
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
        NotificationManager::createNotificationWarning($owner->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
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
        NotificationManager::createNotificationSuccess($owner->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
    }
}
