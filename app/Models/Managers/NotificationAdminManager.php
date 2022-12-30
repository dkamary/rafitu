<?php

namespace App\Models\Managers;

use App\Models\Managers\Interfaces\NotificationInterface;
use App\Models\NotificationParameter;
use App\Models\Reservation;
use App\Models\Ride;

class NotificationAdminManager implements NotificationInterface {

    public static function getAdminEmail() : string {
        $parameter = NotificationParameter::where('id', '=', 1)->first();
        if(!$parameter) {
            $parameter = NotificationParameter::getDefault();
        }

        return $parameter->reservation_email ?? $parameter->admin_email ?? config('rafitu.admin');
    }

    public static function newRide(Ride $ride) {
        $email = self::getAdminEmail();
        $subject = 'Nouveau trajet ajouté';
        $content = view('templates.emails.admin.ride-new', [
            'ride' => $ride,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function newReservation(Reservation $reservation) {
        $email = self::getAdminEmail();
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin.reservation-new', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function cancelReservation(Reservation $reservation) {
        $email = self::getAdminEmail();
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin.reservation-cancel', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }

    public static function payReservation(Reservation $reservation) {
        $email = self::getAdminEmail();
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin.reservation-pay', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }
}
