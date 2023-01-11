<?php

namespace App\Models\Managers;

use App\Models\Managers\Interfaces\NotificationInterface;
use App\Models\Message;
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
        NotificationManager::createNotificationInfo(null, $subject, $ride->toString(), route('ride_show', ['ride' => $ride->id]));
    }

    public static function newReservation(Reservation $reservation) {
        $email = self::getAdminEmail();
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin.reservation-new', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationInfo(null, $subject, $reservation->toString(), route('reservation_show', ['reservation' => $reservation->id]));
    }

    public static function cancelReservation(Reservation $reservation) {
        $email = self::getAdminEmail();
        $subject = 'Réservation annulée';
        $content = view('templates.emails.admin.reservation-cancel', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationWarning(null, $subject, $reservation->toString(), route('reservation_show', ['reservation' => $reservation->id]));
    }

    public static function payReservation(Reservation $reservation) {
        $email = self::getAdminEmail();
        $subject = 'Réservation payée';
        $content = view('templates.emails.admin.reservation-pay', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
        NotificationManager::createNotificationSuccess(null, $subject, $reservation->toString(), route('reservation_show', ['reservation' => $reservation->id]));
    }

    public static function newMessageToAdmin(Message $message) {
        $parameter = NotificationParameter::where('id', '=', 1)->first();
        if(!$parameter) {
            $parameter = NotificationParameter::getDefault();
        }
        $email = $parameter->contact_email;
        $subject = 'RAFITU - Nouveau message';
        $content = view('templates.emails.admin.message-new', [
            'message' => $message,
        ])->render();

        NotificationManager::sendEmail($email, $subject, $content);
    }
}
