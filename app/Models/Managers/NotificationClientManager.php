<?php

namespace App\Models\Managers;

use App\Models\Managers\Interfaces\NotificationInterface;
use App\Models\Reservation;
use App\Models\Ride;

class NotificationClientManager implements NotificationInterface {

    public static function newRide(Ride $ride) {
        //
    }

    public static function newReservation(Reservation $reservation) {
        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.client.reservation-new', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function cancelReservation(Reservation $reservation) {
        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.client.reservation-cancel', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function payReservation(Reservation $reservation) {
        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.client.reservation-pay', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function payNotDone(?Reservation $reservation) {
        if(!$reservation) return;

        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.client.reservation-pay-todo', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }
}
