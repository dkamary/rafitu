<?php

namespace App\Models\Managers;

use App\Models\Reservation;
use CinetPay\CinetPay;
use Exception;

class CinePayManager {
    public static function generateForm($reservation) : string {
        if(!$reservation) throw new Exception("Reservation ne peut pas être NULL!");

        if(!is_object($reservation) || !($reservation instanceof Reservation) && is_numeric($reservation)) {
            $reservation = Reservation::where('id', '=', $reservation)->firstOrFail();
        }

        $form = '';

        /**
         * @var User $user
         */
        $user = $reservation->getuser();
        $ride = $reservation->getRide();

        $transactionId = CinetPay::generateTransId();
        $formName = 'cinetpay-form';
        $btnType = 2; //1-5xwxxw
        $btnSize = 'larger'; // 'small' pour reduire la taille du bouton, 'large' pour une taille moyenne ou 'larger' pour  une taille plus grande

        $siteId = config('cinetpay.site_id');
        $apiKey = config('cinetpay.api_key');

        $cinetpay = new CinetPay($siteId, $apiKey);
        $cinetpay
            ->setTransId($transactionId)
            ->setDesignation(sprintf('Réservation pour le trajet #%d: %s', $ride->id, $ride))
            ->setTransDate(date('Y-m-d H:i:s'))
            ->setAmount($reservation->price)
            ->setCurrency(config('cinetpay.currency'))
            ->setDebug(true) // Valorisé à true, si vous voulez activer le mode debug sur cinetpay afin d'afficher toutes les variables envoyées chez CinetPay
            ->setCustom($user->email) // optional
            ->setNotifyUrl(route('pay_notification')) // optional
            ->setReturnUrl(route('pay_success')) // optional
            ->setCancelUrl(route('pay_cancel')) // optional
        ;
        $form = $cinetpay->getPayButton($formName, $btnType, $btnSize);

        return $form;
    }
}
