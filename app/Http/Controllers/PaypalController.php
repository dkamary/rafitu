<?php

namespace App\Http\Controllers;

use App\Models\Managers\CommissionManager;
use App\Models\Managers\NotificationAdminManager;
use App\Models\Managers\NotificationClientManager;
use App\Models\Managers\NotificationOwnerManager;
use App\Models\Managers\PaypalManager;
use App\Models\Order;
use App\Models\OrderLink;
use App\Models\Position;
use App\Models\Reservation;
use App\Models\Transactions\Result;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaypalController extends Controller
{
    public function pay(Request $request) {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->first();
        if(!$reservation) {
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
                'payer_id' => null,
                'source' => Order::PAYPAL,
            ]);

            // dd([
            //     'order' => $order,
            //     'orderResponse' => $createOrderResponse,
            //     'id' => $createOrderResponse->getId(),
            // ]);

            // COMMISSION
            $commissionPayment = CommissionManager::create($order);

            session()->flash('success', 'La réservation a été payé');

            NotificationAdminManager::payReservation($reservation);
            NotificationOwnerManager::payReservation($reservation);
            NotificationClientManager::payReservation($reservation);

        } catch(QueryException $ex) {
            if($ex->getCode() != 23000){
                dd($ex);
            }
        }

        $orderId = $createOrderResponse->getId();
        foreach($createOrderResponse->getLinks() as $lnk) {
            // dump($lnk);
            $link = new OrderLink();
            $link->order_id = $orderId;
            $link->rel = $lnk->rel;
            $link->href = $lnk->href;

            try {
                $link->save();
            } catch(\Throwable $th) {
                dump($th->getMessage());

                throw $th;
            }
        }

        $reservation->transaction_id = $orderId;
        $reservation->save();

        if($link = $createOrderResponse->getApprovalLink()) {
            return response()->redirectTo($link->href);
        }

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'result' => new Result(Result::STATUS_ERROR, 'Une erreur est survenue lors du processus de paiement', $createOrderResponse),
        ]);
    }

    public function notification(Request $request) {
        //
    }

    public function success(Request $request) {
        $token = $request->input('token');
        $reservation = Reservation::where('transaction_id', 'LIKE', $token)->first();
        if(!$reservation){
            throw new NotFoundHttpException('La réservation associé est introuvable!!!');
        }

        $result = new Result();

        $order = Order::where('id', 'LIKE', $token)->first();

        if($order->status == 'COMPLETED') {
            $result
            ->setStatus(Result::STATUS_SUCCESS)
            ->setMessage('Le paiement a été approuvé');

            return view('pages.payment.result', [
                'reservation' => $reservation,
                'result' => $result,
                'order' => $order,
                'parameters' => [
                    'origin' => new Position(0, 0),
                    'destination' => new Position(0, 0),
                ],
            ]);
        }

        $order->status = 'APPROVED';
        $order->payer_id = $request->input('PayerID');
        $order->save();

        $result
            ->setStatus(Result::STATUS_SUCCESS)
            ->setMessage('Le paiement a été approuvé');

        $token = session()->get('access_token', PaypalManager::getToken()->getAccess_token());
        // dump($order);
        $capture = PaypalManager::capturePayment($token, $order);

        if($capture->intent == 'CAPTURE' && $capture->status == 'COMPLETED') {
            $order->status = 'COMPLETED';
            $reservation->is_paid = 1;
            $reservation->save();
        } else {
            $order->status = $capture->status;
        }
        $order->save();

        // COMMISSION
        $commissionPayment = CommissionManager::create($order);

        session()->flash('success', 'La réservation a été payé');

        NotificationAdminManager::payReservation($reservation);
        NotificationOwnerManager::payReservation($reservation);
        NotificationClientManager::payReservation($reservation);

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'result' => $result,
            'order' => $order,
        ]);
    }

    public function cancel(Request $request) {
        $token = $request->input('token');
        $reservation = Reservation::where('transaction_id', 'LIKE', $token)->first();

        return view('pages.payment.cancel', [
            'reservation' => $reservation,
            'result' => new Result(Result::STATUS_WARNING, 'Le processus de paiement n\'a pas aboutie'),
        ]);
    }
}
