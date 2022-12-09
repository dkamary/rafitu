<?php

namespace App\Http\Controllers;

use App\Models\Managers\PaypalManager;
use App\Models\Order;
use App\Models\OrderLink;
use App\Models\Payments\CinetPay\CinetPay;
use App\Models\Reservation;
use App\Models\Transactions\Result;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payReservation(Request $request) {

    }

    public function payReservationPaypal(Request $request)
    {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->first();
        if (!$reservation) {
            return view('dashboard.reservation.not-found');
        }

        $token = PaypalManager::getToken();
        session()->put('access_token', $token->getAccess_token());
        session()->save();

        $createOrderResponse = PaypalManager::createOrder($token, $reservation);

        try {
            $order = Order::create([
                'id' => $createOrderResponse->getId(),
                'intent' => $createOrderResponse->getIntent(),
                'status' => $createOrderResponse->getStatus(),
                'create_time' => date('Y-m-d H:i:s'),
                'reservation_id' => $reservation->id,
            ]);
        } catch (QueryException $ex) {
            if ($ex->getCode() != 23000) {
                dd($ex);
            }
        }

        $orderId = $createOrderResponse->getId();
        foreach ($createOrderResponse->getLinks() as $lnk) {
            // dump($lnk);
            $link = new OrderLink();
            $link->order_id = $orderId;
            $link->rel = $lnk->rel;
            $link->href = $lnk->href;

            try {
                $link->save();
            } catch (\Throwable $th) {
                dump($th->getMessage());

                throw $th;
            }
        }

        $reservation->transaction_id = $orderId;
        $reservation->save();

        if ($link = $createOrderResponse->getApprovalLink()) {
            return response()->redirectTo($link->href);
        }

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'result' => new Result(Result::STATUS_ERROR, 'Une erreur est survenue lors du processus de paiement', $createOrderResponse),
        ]);
    }

    public function paySuccess(Request $request) : View
    {
        $transactionId = (int)$request->input('transaction_id');
        /**
         * @var Order $order
         */
        $order = Order::where('id', 'LIKE', $transactionId)->firstOrFail();

        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');

        $cinetpay = new CinetPay($siteId, $apiKey);
        $cinetpay->getPayStatus($transactionId, $siteId);

        if($cinetpay->chk_code != '00') {
            throw new Exception($cinetpay->chk_message);
        }

        if($order->status == 'CREATED') {
            $reservation = $order->getReservation();
            if(!$reservation) {
                throw new Exception("Réservation `{$order->reservation_id}` introuvable");
            }

            $reservation->transaction_id = $transactionId;
            $reservation->is_paid = 1;
            $reservation->payment_date = date('Y-m-d H:i:s');
            $order->status = 'PAID';

            $reservation->save();
            $order->save();

            session()->flash('success', 'La réservation a été payé');
        }

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'order' => $order,
            'result' => new Result(Result::STATUS_SUCCESS, "La réservation a été payé"),
        ]);
    }

    public function payCancel(Request $request): View
    {
        $token = $request->input('token');
        $reservation = Reservation::where('transaction_id', 'LIKE', $token)->first();

        return view('pages.payment.cancel', [
            'reservation' => $reservation,
            'result' => new Result(Result::STATUS_WARNING, 'Le processus de paiement n\'a pas aboutie'),
        ]);
    }

    public function notification(Request $request)
    {
        $transactionId = $request->input('cpm_trans_id');
        /**
         * @var Order $order
         */
        $order = Order::where('id', 'LIKE', $transactionId)->firstOrFail();
        $reservation = $order->getReservation();
        if(!$reservation) throw new NotFoundHttpException('Reservation introuvable!!!');

        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');

        $cinetpay = new CinetPay($siteId, $apiKey);

        if($order->status == 'PAID') {
            // Ne fais rien
            echo "Déjà payé";
            die();
        }

        $cinetpay->getPayStatus($transactionId, $siteId);

        if($cinetpay->chk_code == '00') {
            $reservation->transaction_id = $transactionId;
            $reservation->is_paid = 1;
            $reservation->payment_date = date('Y-m-d H:i:s');
            $order->status = 'PAID';

            $reservation->save();
            $order->save();

            return response()->json([
                'cinetpay' => $cinetpay,
            ]);
        } else {
            echo "Echec de transaction";
            dd($cinetpay);
            die();
        }
    }

    public function cinetpay(Request $request) : RedirectResponse {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->firstOrFail();
        $user = $reservation->getuser();
        $ride = $reservation->getRide();

        $transactionId = date('YmdHis');
        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');
        $notifyUrl = route('pay_notification');
        $returnUrl = route('pay_success');
        $cancelUrl = route('pay_cancel');
        $channels = 'ALL';

        $params = [
            'transaction_id'=> $transactionId,
            // 'amount'=> $reservation->price,
            'amount'=> 100,
            'currency'=> config('cinetpay.currency'),
            'customer_surname'=> $user->firstname,
            'customer_name'=> $user->lastname,
            'description'=> sprintf('Trajet #%d: %s', $ride->id, $ride),
            'notify_url' => $notifyUrl,
            'return_url' => $returnUrl,
            'cancel_url' => $cancelUrl,
            'channels' => $channels,
            'invoice_data' => [],
            //pour afficher le paiement par carte de credit
            'customer_email' => $user->email, //l'email du client
            'customer_phone_number' => $user->mobile, //Le numéro de téléphone du client
            'customer_address' => $user->address_line1 . (strlen($user->address_line2) > 0 ? ' ' . $user->address_line2 : ''), //l'adresse du client
            'customer_city' => '', // ville du client
            'customer_country' => '',//Le pays du client, la valeur à envoyer est le code ISO du pays (code à deux chiffre) ex : CI, BF, US, CA, FR
            'customer_state' => '', //L’état dans de la quel se trouve le client. Cette valeur est obligatoire si le client se trouve au États Unis d’Amérique (US) ou au Canada (CA)
            'customer_zip_code' => '' //Le code postal du client
        ];

        $order = Order::create([
            'id' => $transactionId,
            'intent' => 'ORDER',
            'status' => 'CREATED',
            'create_time' => date('Y-m-d H:i:s'),
            'reservation_id' => $reservation->id,
            'payer_id' => $user->id,
        ]);

        $cinetpay = new CinetPay($siteId, $apiKey);
        $result = $cinetpay->generatePaymentLink($params);

        if($result['code'] != '201') {
            dd($result);
        }

        return response()->redirectTo($result['data']['payment_url']);
    }
}
