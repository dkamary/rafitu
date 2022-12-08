<?php

namespace App\Models\Managers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Payments\Paypal\CreateOrderResponse;
use App\Models\Payments\Paypal\Item;
use App\Models\Payments\Paypal\Request;
use App\Models\Payments\Paypal\Token;
use App\Models\Payments\Paypal\UnitAmount;
use App\Models\Reservation;
use App\Models\Transactions\Result;
use Exception;

class PaypalManager
{
    const MIME_JSON = 'Application/json';
    const TOKEN_HEADERS = [
        'Authorization: Basic QWFLaFNrbnFEX0VaX1pLWUU1Y3BQMFZPNnB3WlhSUjlyeWdoUE9oVnBNSXBfcWE4MFNrWktybUVsaDJUTGJXcHF3WlluT0MyajdycVhlVlQ6RUR0a1kybEpqaENrUnF2WS15S1hsckZiUHEzX1RRVnZZN1UzY2RIMG03U211UzYxNmctNTZVanNBM0FhNklIRHRHLVREUjFqYnRuUGotT3E=',
        'Content-Type: application/x-www-form-urlencoded'
    ];

    public static function getToken(): Token
    {
        $curl = curl_init();

        $headers = [
            'Authorization: Basic QWFLaFNrbnFEX0VaX1pLWUU1Y3BQMFZPNnB3WlhSUjlyeWdoUE9oVnBNSXBfcWE4MFNrWktybUVsaDJUTGJXcHF3WlluT0MyajdycVhlVlQ6RUR0a1kybEpqaENrUnF2WS15S1hsckZiUHEzX1RRVnZZN1UzY2RIMG03U211UzYxNmctNTZVanNBM0FhNklIRHRHLVREUjFqYnRuUGotT3E=',
            'Content-Type: application/x-www-form-urlencoded'
        ];
        $postFields = 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true';

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  'https://api-m.sandbox.paypal.com/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        if (!$response) {
            curl_close($curl);

            throw new Exception(sprintf(
                'Une erreur est survenue lors de la récupération du token: %s!',
                curl_error($curl)
            ));
        }

        $data = json_decode($response, true);
        if (!$data) {
            $message = curl_error($curl);
            curl_close($curl);

            throw new Exception($message);
        }

        $token = new Token($data);
        curl_close($curl);

        return $token;
    }

    public static function createOrder(Token $token, Reservation $reservation)
    {
        $curl = curl_init();
        $ride = $reservation->getRide();
        $price = (float)$reservation->price;
        if($price > 100) {
            $price /= 100;
        }
        $price = number_format($price, 2, '.', '');
        $postFields = '{
            "intent": "CAPTURE",
            "purchase_units": [
                {
                    "items": [
                        {
                            "name": "Traject #' .$ride->id .'",
                            "description": "'.$ride->departure_label .'",
                            "quantity": "1",
                            "unit_amount": {
                                "currency_code": "USD",
                                "value": "'. $price .'"
                            }
                        }
                    ],
                    "amount": {
                        "currency_code": "USD",
                        "value": "'. $price .'",
                        "breakdown": {
                            "item_total": {
                                "currency_code": "USD",
                                "value": "'. $price .'"
                            }
                        }
                    }
                }
            ],
            "application_context": {
                "return_url": "' . route('pay_success') . '",
                "cancel_url": "' . route('pay_cancel') . '"
            }
        }';
        // dd($postFields);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/checkout/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Prefer: return=representation',
                // 'PayPal-Request-Id: 75fbd487-035c-4fb0-a360-3d7f5f7a5dfe',
                'Authorization: Bearer ' . $token->getAccess_token()
            ),
        ));

        $response = curl_exec($curl);
        $data = json_decode($response);

        curl_close($curl);

        return new CreateOrderResponse($data);
    }

    public static function capturePayment(string $token, Order $order)
    {
        $curl = curl_init();
        $attributes = $order->getAttributes();
        $url = 'https://api-m.sandbox.paypal.com/v2/checkout/orders/'. ($attributes['id'] ?? $order->id) .'/capture';

        // dump([
        //     'attributes' => $attributes['id'],
        //     'url' => $url,
        //     'token' => $token,
        //     'order' => $order,
        // ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Prefer: return=representation',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        if(!$response) {
            $message = curl_error($curl);
            curl_close($curl);

            throw new Exception($message);
        }

        curl_close($curl);

        return json_decode($response);
    }
}
