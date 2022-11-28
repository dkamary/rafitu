<?php

namespace App\Http\Controllers;

use App\Models\Managers\ReservationManager;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller {

    public function submit(Request $request) : RedirectResponse {
        $data = ReservationManager::getDataFromRequest($request);
        $reservation = Reservation::create($data);

        return response()->redirectToRoute('reservation_result', [
            'reservation' => $reservation,
        ]);
    }

    public function result(Reservation $reservation):  View {
        return view('pages.reservation.result', [
            'reservation' => $reservation,
        ]);
    }

    public function show(Reservation $reservation) : View {
        return view('pages.reservation.show', [
            'reservation'=> $reservation,
        ]);
    }
}
