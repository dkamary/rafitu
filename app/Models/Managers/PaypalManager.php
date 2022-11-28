<?php

namespace App\Models\Managers;

use App\Models\Payment;
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

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  config('paypal.entry'), // 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => self::TOKEN_HEADERS,
        ));

        $response = curl_exec($curl);
        if (!$response) {
            curl_close($curl);

            throw new Exception(sprintf(
                'Une erreur est survenue lors de la récupération du token: %s!',
                curl_error($curl)
            ));
        }

        curl_close($curl);

        $data = json_decode($response, true);
        $token = new Token($data);

        return $token;
    }

    public static function payReservation(Reservation $reservation): Result
    {
        $result = new Result();

        $request = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'items' => [
                        [
                            'name' => 'Reservation #' . $reservation->id,
                            'description' => 'Trajet #' . $reservation->getRide()->id,
                            'quantity' => 1,
                            'unit_amount' => [
                                'currency_code' => 'USD',
                                'value' => $reservation->price,
                            ]
                        ],
                    ],
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $reservation->price,
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'USD',
                                'value' => $reservation->price,
                            ]
                        ]
                    ],
                ]
            ],
            'application_context' => [
                'return_url' => route('pay_success'),
                'cancel_url' => route('pay_cancel'),
            ]
        ];

        // dd($request->jsonSerialize());
        $postfields = json_encode($request);
        $curl = curl_init();

        $authorization = base64_encode(sprintf('%s:%s', config('paypal.client_id'), config('paypal.secret')));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/checkout/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Prefer: return=representation',
                // 'PayPal-Request-Id: 5dbde5e1-8d4e-4256-8513-d72553030668',
                'Authorization: Basic ' . $authorization
            ),
        ));

        $response = curl_exec($curl);
        if (!$response) {
            $error = curl_error($curl);
            curl_close($curl);

            throw new Exception(sprintf('Une erreur est survenue: `%s`', $error));
        }
        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            $result
                ->setStatus(Result::STATUS_ERROR)
                ->setData($data)
                ->setMessage($data['error_description'] ?? 'Une erreur est survenue');
        } elseif (isset($data['name'])) {
            $result
                ->setStatus(Result::STATUS_ERROR)
                ->setMessage(sprintf('%s : %s', $data['name'], $data['message']))
                ->setData($data);
        } else {
            if(isset($data['id'])) {
                $reservation->is_paid = 1;
                $reservation->payment_date = date('Y-m-d H:i:s');
                $reservation->transaction_id = $data['id'];
                $reservation->save();

                $payment = Payment::create([
                    'reservation_id' => $reservation->id,
                    'referrence_id' => $reservation->transaction_id,
                    'amount' => $reservation->price,
                    'payment_date' => date('Y-m-d H:i:s'),
                    'raw_data' => $response,
                ]);
            }
            $result
                ->setStatus(Result::STATUS_SUCCESS)
                ->setData([
                    'data' => $data,
                    'payment' => $payment,
                    'reservation' => $reservation,
                ])
                ->setMessage('Paiement effectué avec succès!');
        }

        // echo '<pre>';
        // echo $postfields;
        // echo '</pre>';

        // dd([
        //     'request' => $request,
        //     'json' => $postfields,
        //     'data' => $data,
        //     'result' => $result,
        // ]);

        return $result;
    }
}
