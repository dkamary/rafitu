<?php

namespace App\Http\Controllers;

use App\Models\Managers\NotificationAdminManager;
use App\Models\Managers\NotificationClientManager;
use App\Models\Managers\NotificationManager;
use App\Models\Managers\NotificationOwnerManager;
use App\Models\Managers\ReservationManager;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ReservationController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit(Request $request) : RedirectResponse {
        $data = ReservationManager::getDataFromRequest($request);
        $reservation = Reservation::create($data);

        NotificationAdminManager::newReservation($reservation);
        NotificationOwnerManager::newReservation($reservation);
        NotificationClientManager::newReservation($reservation);

        return response()->redirectToRoute('reservation_result', [
            'reservation' => $reservation,
        ]);
    }

    public function result(Reservation $reservation):  View {
        return view('reservation.paiement', ['reservation' => $reservation]);
    }

    public function show(Reservation $reservation) : View {
        return view('pages.reservation.show', [
            'reservation'=> $reservation,
        ]);
    }

    public function cancel(Request $request) : RedirectResponse {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->first();

        if(!$reservation) {
            Session::flash('error', "La réservation est introuvable!");

            return response()->redirectToRoute('dashboard_reservations');
            // return response()->redirectToRoute('reservation_canceled', ['reservation' => $reservation]);
        }

        $reservation
            ->cancel()
            ->save();

        $order = $reservation->getOrder();
        if(!$order) {
            Session::flash('warning', "Une erreur est survenue dans l'annulation!");
            NotificationAdminManager::cancelReservation($reservation);

            return response()->redirectToRoute('dashboard_reservations');
            // return response()->redirectToRoute('reservation_canceled', ['reservation' => $reservation]);
        }

        if($order->intent == 'ORDER') {
            $order->status = 'CANCEL';
            $order->save();
            Session::flash('success', "La réservation a bien été annulée !");

            NotificationAdminManager::cancelReservation($reservation);
            NotificationOwnerManager::cancelReservation($reservation);
            NotificationClientManager::cancelReservation($reservation);

            return response()->redirectToRoute('dashboard_reservations');
        }

        Session::flash('success', "La réservation a été annulée !");

        NotificationAdminManager::cancelReservation($reservation);
        NotificationOwnerManager::cancelReservation($reservation);
        NotificationClientManager::cancelReservation($reservation);

        return response()->redirectToRoute('dashboard_reservations');
    }

    public function canceled(Reservation $reservation) : View {

        return view('reservation.canceled', ['reservation' => $reservation]);
    }
}
