<?php

namespace App\Http\Controllers;

use App\Models\Managers\PaypalManager;
use App\Models\Reservation;
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
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->first();
        if(!$reservation) {
            return view('dashboard.reservation.not-found');
        }

        $result = PaypalManager::payReservation($reservation);
        session()->put('result', $result);
        session()->save();

        return response()->redirectToRoute('pay_success');

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'result' => $result,
        ]);
    }

    public function paySuccess(Request $request) : View {
        $result = session()->get('result');
        if(!$result) throw new NotFoundHttpException('Result not found!');
        $data = $result->getData();
        $reservation = $data['reservation'];
        $payment = $data['payment'];

        return view('pages.payment.result', [
            'reservation' => $reservation,
            'result' => $result,
        ]);
    }

    public function payCancel(Request $request) : View {
        dd($request);
        return view('');
    }
}
