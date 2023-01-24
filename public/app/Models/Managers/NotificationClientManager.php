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
        NotificationManager::createNotificationInfo($client->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
    }

    public static function cancelReservation(Reservation $reservation) {
        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Réservation annulée';
        $content = view('templates.emails.client.reservation-cancel', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationWarning($client->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
    }

    public static function payReservation(Reservation $reservation) {
        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Réservation payée';
        $content = view('templates.emails.client.reservation-pay', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationSuccess($client->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
    }

    public static function payNotDone(?Reservation $reservation) {
        if(!$reservation) return;

        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Réservation en attente';
        $content = view('templates.emails.client.reservation-pay-todo', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationInfo($client->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
    }

    public static function rideReview(?Reservation $reservation) {
        if(!$reservation) return;

        $client = $reservation->getuser();
        $email = $client->email;

        $subject = 'Votre avis nous intéresse';
        $content = view('templates.emails.client.reservation-pay-todo', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationInfo($client->id, $subject, $reservation->toString(), route('dashboard_reservation_show', ['reservation' => $reservation->id]));
    }
}
