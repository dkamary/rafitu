<?php

namespace App\Models\Managers;

use App\Models\Order;
use App\Models\Reservation;
use App\Models\Ride;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationManager {
    public static function sendEmail(string $to, string $subject, string $content) {
        try {
            $headers = "MIME-Version: 1.0 \r\n";
            $headers .= "Content-type:text/html;charset=UTF-8 \r\n";
            $headers .= "From: RAFITU <noreply@rafitu.com> \r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion() ."\r\n";

            mail($to, $subject, $content, $headers);
        } catch(Throwable $th) {
            Log::warning(sprintf('Une erreur est survenue lors l\'envoie de mail: %s', $th->getMessage()));
        }
    }

    public static function adminNewRide(Ride $ride) {
        $subject = 'Nouveau trajet ajouté';
        $content = view('templates.emails.admin-ride-new', [
            'ride' => $ride,
        ])->render();

        self::sendEmail(config('rafitu.admin'), $subject, $content);
    }

    public static function adminNewReservation(Reservation $reservation) {
        $subject = 'Nouvelle réservation';
        $content = view('templates.emails.admin-ride-new', [
            'reservation' => $reservation,
        ])->render();

        self::sendEmail(config('rafitu.admin'), $subject, $content);
    }

    public static function adminNewPaiement(Order $order) {
        //
    }

    public static function ownerNewRide(Ride $ride) {
        //
    }

    public static function ownerNewReservation(Reservation $reservation) {
        //
    }

    public static function ownerNewPaiement(Order $order) {
        //
    }

}
