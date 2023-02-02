<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationAdminController extends Controller
{
    public function allReservation(): View {
        $reservations = Reservation::where(function(Builder $builder) {
            $builder
                ->where('status', 'like', 'paid', 'or')
                ->where('status', 'like', 'unpaid', 'or');
        })
        ->orderBy('reservation_date', 'DESC')
        ->paginate(20);

        return view('admin.reservation.liste', [
            'reservations' => $reservations,
            'title' => 'Toutes les réservations',
            'bg_header' => 'bg-secondary',
        ]);
    }

    public function paidReservation() : View {
        $reservations = Reservation::where('status', 'like', 'paid')
        ->orderBy('reservation_date', 'DESC')
        ->paginate(20);

        return view('admin.reservation.liste', [
            'reservations' => $reservations,
            'title' => 'Réservations payées',
            'bg_header' => 'bg-dark',
        ]);
    }

    public function unpaidReservation() : View {
        $reservations = Reservation::where('status', 'like', 'unpaid')
        ->orderBy('reservation_date', 'DESC')
        ->paginate(20);

        return view('admin.reservation.liste', [
            'reservations' => $reservations,
            'title' => 'Réservations impayées',
            'bg_header' => 'bg-info',
        ]);
    }

    public function canceledReservation() : View {
        $reservations = Reservation::where('status', 'like', 'cancel')
        ->orderBy('reservation_date', 'DESC')
        ->paginate(20);

        return view('admin.reservation.liste', [
            'reservations' => $reservations,
            'title' => 'Réservations annulées',
            'bg_header' => 'bg-warning',
        ]);
    }

    public function deletedReservation() : View {
        $reservations = Reservation::where('status', 'like', 'delete')
        ->orderBy('reservation_date', 'DESC')
        ->paginate(20);

        return view('admin.reservation.liste', [
            'reservations' => $reservations,
            'title' => 'Réservations effacées',
            'bg_header' => 'bg-danger',
        ]);
    }

    public function details(Reservation $reservation) : View {
        return view('admin.reservation.details', [
            'reservation' => $reservation,
        ]);
    }

    public function remove(Request $request, Reservation $reservation) : RedirectResponse {
        $reservation->status = 'delete';
        $reservation->save();

        session()->flash('success', 'Réservation effacée');

        return response()->redirectToRoute('admin_reservation_all');
    }

    public function cancel(Request $request, Reservation $reservation) : RedirectResponse {
        $reservation->status = 'cancel';
        $reservation->save();

        session()->flash('success', 'Réservation annulée');

        return response()->redirectToRoute('admin_reservation_all');
    }
}
