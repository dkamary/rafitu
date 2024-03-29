<?php

namespace App\Http\Controllers;

use App\Models\Managers\CommissionManager;
use App\Models\Managers\NotificationAdminManager;
use App\Models\Managers\NotificationClientManager;
use App\Models\Managers\NotificationManager;
use App\Models\Managers\NotificationOwnerManager;
use App\Models\Order;
use App\Models\Payments\CinetPay\CinetPay;
use App\Models\Reservation;
use App\Models\Transactions\Result;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CinetPayController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    private function paymentEvent(Order $order, Reservation $reservation) {
        // COMMISSION
        $commissionPayment = CommissionManager::create($order);

        // session()->flash('success', 'La réservation a été payé');

        NotificationAdminManager::payReservation($reservation);
        NotificationOwnerManager::payReservation($reservation);
        NotificationClientManager::payReservation($reservation);
    }

    /**
     * Paiement et Redirection vers CinetPay
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function pay(Request $request) : RedirectResponse {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->firstOrFail();
        $user = $reservation->getuser();
        $ride = $reservation->getRide();

        $transactionId = date('YmdHis');
        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');
        $notifyUrl = route('cinetpay_success');
        $returnUrl = route('cinetpay_return');
        $cancelUrl = route('cinetpay_cancel');
        $channels = 'ALL';

        $params = [
            'transaction_id'=> $transactionId,
            'amount'=> $reservation->getAmount(),
            // 'amount'=> 100,
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
            'status' => Order::STATUS_CREATED,
            'create_time' => date('Y-m-d H:i:s'),
            'reservation_id' => $reservation->id,
            'payer_id' => $user->id,
            'source'=> Order::CINETPAY,
        ]);

        $cinetpay = new CinetPay($siteId, $apiKey);
        $result = $cinetpay->generatePaymentLink($params);

        if($result['code'] != '201') {
            Log::critical('Une erreur est survenue lors de la génération du lien de paiement vers CinetPay!', [
                'result' => $result,
                'transaction_id' => $transactionId,
                'notify_url' => $notifyUrl,
                'return_url' => $returnUrl,
                'cancel_url' => $cancelUrl,
            ]);

            throw new Exception("Une erreur est survenue lors de la génération du lien de paiement vers CinetPay!");
        }

        return response()->redirectTo($result['data']['payment_url']);
    }

    /**
     * Notification de paiement
     *
     * @param Request $request
     * @return void
     */
    public function notification(Request $request) {
        $transactionId = $request->input('cpm_trans_id');
        /**
         * @var Order $order
         */
        $order = Order::where('id', 'LIKE', $transactionId)->first();
        if(!$order) {
            return response()->json([
                'done' => false,
                'error'=> true,
                'message'=> "L'ordre n'a pas été trouvé!",
            ], 404);
        }
        $reservation = $order->getReservation();
        if(!$reservation) {
            return response()->json([
                'done' => false,
                'error' => true,
                'message' => 'Reservation introuvable!!!',
            ], 404);
        }

        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');

        $cinetpay = new CinetPay($siteId, $apiKey);

        if($order->status == 'PAID') {
            return response()->json([
                'done' => true,
                'error' => false,
                'message' => 'Le paiement a déjà été fait!',
            ]);
        }

        $cinetpay->getPayStatus($transactionId, $siteId);

        if($cinetpay->chk_code == '00') {
            $reservation->transaction_id = $transactionId;
            $reservation->payment_date = date('Y-m-d H:i:s');
            $order->status = 'PAID';

            $reservation
                ->paid()
                ->save();
            $order->save();

            $this->paymentEvent($order, $reservation);

            return response()->json([
                'done' => true,
                'error' => false,
                'message' => 'Le paiement a été effectué',
                'cinetpay' => $cinetpay,
            ]);
        } else {

            return response()->json([
                'done' => true,
                'error' => true,
                'message' => 'Echec de transaction!',
                'cinetpay' => $cinetpay,
            ]);
        }
    }

    public function retour(Request $request) : View {
        $token = $request->input('token');
        $transactionId = $request->input('transaction_id');

        if(!$transactionId) {

            throw new Exception("Aucune donnée de transaction n'a été transmise de la plateforme de paiement vers notre site!");
        }

        $builder = Order::where('id', 'LIKE', $transactionId);
        /**
         * @var Order $order
         */
        $order = $builder->first();

        if(!$order) {

            throw new Exception("L'information de la transaction est introuvable [$transactionId]");
        }

        $reservation = $order->getReservation();

        $user = $reservation->getuser();
        if($user) {
            auth()->login($user);
        }

        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');

        $cinetpay = new CinetPay($siteId, $apiKey);
        $cinetpay->getPayStatus($transactionId, $siteId);

        if($cinetpay->chk_code == '662') {
            NotificationClientManager::payNotDone($reservation);

            return view('pages.payment.return', [
                'reservation' => $reservation,
                'order' => $order,
                'result' => new Result(Result::STATUS_WARNING, "En attente de paiement. Veuillez compléter votre paiement!"),
            ]);
        } elseif($cinetpay->chk_code == '604') {
            NotificationClientManager::payNotDone($reservation);

            return view('pages.payment.return', [
                'reservation' => $reservation,
                'order' => $order,
                'result' => new Result(Result::STATUS_WARNING, "Le code One Time Password fournis est incorrect!"),
            ]);
        } elseif($cinetpay->chk_code != '00') {
            NotificationClientManager::payNotDone($reservation);

            return view('pages.payment.return', [
                'reservation' => $reservation,
                'order' => $order,
                'result' => new Result(Result::STATUS_WARNING, sprintf('Code: %s, Message: %s', $cinetpay->chk_code, $cinetpay->chk_message)),
            ]);
        }

        return view('pages.payment.return', [
            'reservation' => $reservation,
            'order' => $order,
            'result' => new Result(Result::STATUS_WARNING, "Nous n'avons pas pu déterminer le status du paiement que vous avez effectué!"),
        ]);
    }

    public function success(Request $request) {
        $token = $request->input('token');
        $transactionId = $request->input('transaction_id');

        // dd([
        //     'token' => $token,
        //     'transactionID' => $transactionId,
        // ]);

        if(!$transactionId) {

            return response()->json([
                'done' => false,
                'error' => false,
                'message' => 'Transaction ID is null!',
            ]);
        }

        $builder = Order::where('id', 'LIKE', $transactionId);
        /**
         * @var Order $order
         */
        $order = $builder->first();
        if(!$order) {

            return response()->json([
                'done' => false,
                'error' => true,
                'message' => 'Order not found!',
            ]);
        }

        $apiKey = config('cinetpay.api_key');
        $siteId = config('cinetpay.site_id');

        $cinetpay = new CinetPay($siteId, $apiKey);
        $cinetpay->getPayStatus($transactionId, $siteId);

        if($cinetpay->chk_code == '662') {
            $reservation = $order->getReservation();

            NotificationClientManager::payNotDone($reservation);

            return view('pages.payment.result', [
                'reservation' => $order->getReservation(),
                'order' => $order,
                'result' => new Result(Result::STATUS_WARNING, "En attente de paiement. Veuillez compléter votre paiement!"),
            ]);
        }elseif($cinetpay->chk_code != '00') {
            // dd($cinetpay);
            // throw new Exception($cinetpay->chk_message);
            $reservation = $order->getReservation();

            NotificationClientManager::payNotDone($reservation);

            return view('pages.payment.result', [
                'reservation' => $order->getReservation(),
                'order' => $order,
                'result' => new Result(Result::STATUS_WARNING, $cinetpay->chk_message),
            ]);
        }

        $reservation = $order->getReservation();

        if($order->status == Order::STATUS_CREATED) {
            $reservation = $order->getReservation();
            if(!$reservation) {
                throw new Exception("Réservation `{$order->reservation_id}` introuvable");
            }

            $reservation->transaction_id = $transactionId;
            $reservation->payment_date = date('Y-m-d H:i:s');
            $order->status = Order::STATUS_PAID;

            $reservation
                ->paid()
                ->save();
            $order->save();

            $this->paymentEvent($order, $reservation);
        }

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'order' => $order,
            'result' => new Result(Result::STATUS_SUCCESS, "La réservation a été payée"),
        ]);
    }

    public function cancel(Request $request) {
        $token = $request->input('token');
        $reservation = Reservation::where('transaction_id', 'LIKE', $token)->first();

        if(!$reservation) {

            return view('pages.payment.cancel', [
                'reservation' => $reservation,
                'result' => new Result(Result::STATUS_WARNING, 'Le processus de paiement n\'a pas aboutie'),
            ]);
        }

        $reservation
            ->cancel()
            ->save();

        // NotificationManager::adminNewPaiement();

        return view('pages.payment.cancel', [
            'reservation' => $reservation,
            'result' => new Result(Result::STATUS_WARNING, 'Le processus de paiement n\'a pas aboutie'),
        ]);
    }

    public function transfert(Request $request) : JsonResponse {
        $postData = file_get_contents('php://input');

        // Décoder les données JSON
        $response = json_decode($postData);

        Log::debug($postData, [
            'response' => $response,
        ]);

        return response()->json([
            'response' => $response,
        ]);
    }
}
