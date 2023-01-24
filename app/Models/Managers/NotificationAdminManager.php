<?php

namespace App\Models\Managers;

use App\Models\Managers\Interfaces\NotificationInterface;
use App\Models\Message;
use App\Models\NotificationParameter;
use App\Models\Reservation;
use App\Models\Ride;
use App\Models\User;

class NotificationAdminManager implements NotificationInterface {

    public static function getAdminEmail() : string {
        $parameter = NotificationParameter::where('id', '=', 1)->first();
        if(!$parameter) {
            $parameter = NotificationParameter::getDefault();
        }

        return $parameter->reservation_email ?? $parameter->admin_email ?? config('rafitu.admin');
    }

    public static function newRide(Ride $ride) {
        $emails = self::getEmailsOfAdmin();
        $subject = 'Nouveau trajet ajouté';
        $content = view('templates.emails.admin.ride-new', [
            'ride' => $ride,
        ])->render();

        NotificationManager::sendEmail($emails, $subject, $content);
        NotificationManager::createNotificationInfo(null, $subject, $ride->toString(), route('ride_show', ['ride' => $ride->id]));
    }

    public static function newReservation(Reservation $reservation) {
        $emails = self::getEmailsOfAdmin();
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin.reservation-new', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($emails, $subject, $content);
        NotificationManager::createNotificationInfo(null, $subject, $reservation->toString(), route('reservation_show', ['reservation' => $reservation->id]));
    }

    public static function cancelReservation(Reservation $reservation) {
        $emails = self::getEmailsOfAdmin();
        $subject = 'Réservation annulée';
        $content = view('templates.emails.admin.reservation-cancel', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($emails, $subject, $content);
        NotificationManager::createNotificationWarning(null, $subject, $reservation->toString(), route('reservation_show', ['reservation' => $reservation->id]));
    }

    public static function payReservation(Reservation $reservation) {
        $emails = self::getEmailsOfAdmin();
        $subject = 'Réservation payée';
        $content = view('templates.emails.admin.reservation-pay', [
            'reservation' => $reservation,
        ])->render();

        NotificationManager::sendEmail($emails, $subject, $content);
        NotificationManager::createNotificationSuccess(null, $subject, $reservation->toString(), route('reservation_show', ['reservation' => $reservation->id]));
    }

    public static function newMessageToAdmin(Message $message) {
        $parameter = NotificationParameter::where('id', '=', 1)->first();
        if(!$parameter) {
            $parameter = NotificationParameter::getDefault();
        }
        $emails = self::getEmailsOfAdmin();
        $subject = 'RAFITU - Nouveau message';
        $content = view('templates.emails.admin.message-new', [
            'message' => $message,
        ])->render();

        NotificationManager::sendEmail($emails, $subject, $content);
    }

    public static function notifyReservation(array $data) {
        $subject = 'Nouvelle demande de réservation';
        $content = view('templates.emails.admin.request-new', $data)->render();

        $emails = self::getEmailsOfAdmin();

        NotificationManager::sendEmail($emails, $subject, $content);

        NotificationManager::createNotificationSuccess(null, $subject, '', route('admin_prereservation_index'));
    }

    public static function getEmailsOfAdmin() : string {
        $email = self::getAdminEmail();
        $emails = '';
        $admins = User::where('user_type_id', '=', 1)
            ->whereIn('user_status_id', [1, 5])
            ->get();
        $first = true;
        foreach($admins as $user) {
            $emails .= (!$first ? ', ' : '') . $user->email;
            $first = false;
        }

        if(strpos($emails, $email) !== false) {
            $emails = $email .', ' . $emails;
        }

        return $emails;
    }
}
