<?php

namespace App\Http\Controllers;

use App\Models\Managers\NotificationManager;
use App\Models\Managers\ReservationManager;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit(Request $request) : RedirectResponse {
        $data = ReservationManager::getDataFromRequest($request);
        $reservation = Reservation::create($data);

        NotificationManager::adminNewReservation($reservation);
        NotificationManager::ownerNewReservation($reservation);

        return response()->redirectToRoute('reservation_result', [
            'reservation' => $reservation,
        ]);
    }

    public function result(Reservation $reservation):  View {
        return view('reservation.paiement', ['reservation' => $reservation]);

        // return view('pages.reservation.result', [
        //     'reservation' => $reservation,
        // ]);
    }

    public function show(Reservation $reservation) : View {
        return view('pages.reservation.show', [
            'reservation'=> $reservation,
        ]);
    }

    public function cancel(Request $request) : RedirectResponse {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->first();

        if(!$reservation) {
            return response()->redirectToRoute('reservation_canceled', ['reservation' => $reservation]);
        }

        $order = $reservation->getOrder();
        if(!$order) {
            return response()->redirectToRoute('reservation_canceled', ['reservation' => $reservation]);
        }

        if($order->intent == 'ORDER') {
            $order->status = 'CANCEL';
            $order->save();

            return response()->redirectToRoute('reservation_canceled', ['reservation' => $reservation]);
        }

        // Remboursement
        return response()->redirectToRoute('reservation_canceled', ['reservation' => $reservation]);
    }

    public function canceled(Reservation $reservation) : View {

        return view('reservation.canceled', ['reservation' => $reservation]);
    }
}
