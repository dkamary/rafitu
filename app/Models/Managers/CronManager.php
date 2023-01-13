<?php

namespace App\Models\Managers;

use App\Models\CommissionPayment;
use App\Models\Reservation;
use App\Models\ReviewHistory;
use App\Models\Transactions\Result;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CronManager {

    /**
     * Traitement des commissions à payer
     *
     * @return Result
     */
    public static function commissions() : Result {
        $unpaids = CommissionManager::unpaidCommission(CommissionPayment::SOURCE_CINETPAY);
        if($unpaids->count() == 0) {
            return new Result(
                Result::STATUS_SUCCESS,
                'Aucune commission à traiter',
                $unpaids
            );
        }

        Log::info(sprintf('Il y %d commissions à gérer!', $unpaids->count()));
        $parameter = ParamManager::getParameters();
        $heure_execution = (int)$parameter->heure_execution; // 57600s

        foreach($unpaids as $commission) {
            /**
             * @var CommissionPayment $commission
             */
            $dateCreation = new DateTime($commission->created_at);
            $now = new DateTime();
            $diff = $now->diff($dateCreation);

            $seconds = $diff->s + ($diff->i * 60) + ($diff->h * 3600) + ($diff->d * 3600 * 24) + ($diff->m * 3600 * 24 * 30) + ($diff->y * 3600 * 24 * 365);
            if($seconds > $heure_execution) {
                // Paiement du destinataire
                // Mise à jour du commission Paiement
                if(CommissionManager::executePayment($commission)) {
                    $commission
                        ->paid()
                        ->save();
                } else {
                    Log::alert('Le paiement de la commission d\'un chauffeur a échoué!', ['commission' => $commission]);
                    NotificationManager::sendEmail('donatkamary@gmail.com', 'Paiement de commission a échoué', print_r($commission, true));

                    return new Result(
                        Result::STATUS_WARNING,
                        'Le paiement de la commission d\'un chauffeur a échoué!',
                        $commission
                    );
                }
            }
        }

        return new Result(
            Result::STATUS_SUCCESS,
            sprintf('Traitement de %d commission%s', $unpaids->count(), $unpaids->count() > 1 ? 's' : '')
        );
    }

    /**
     * Traitement des avis
     *
     * @return Result
     */
    public static function reviews() : Result {
        $finished = ReservationManager::getReservationsFinished();

        if($finished->count() == 0) {
            return new Result(
                Result::STATUS_SUCCESS,
                'Aucune réservation à traiter',
                $finished
            );
        }

        /**
         * @var Reservation $reservation
         */
        foreach($finished as $reservation) {
            ReviewHistory::create([
                'reservation_id' => (int)$reservation->id,
                'status' => ReviewHistory::STATUS_SENT,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            NotificationClientManager::rideReview($reservation);
        }

        return new Result(
            Result::STATUS_SUCCESS,
            'Les demandes d\'avis ont été envoyées',
            $finished
        );
    }
}
