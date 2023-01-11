<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mes Avis
     *
     * @return View
     */
    public function index() : View {
        return view('');
    }

    /**
     * UI pour l'ajout d'un avis
     *
     * @param Reservation $reservation
     * @return View
     */
    public function add(Reservation $reservation) : View {
        return view('review.add', ['reservation' => $reservation,]);
    }

    /**
     * Soumission de l'avis
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function submit(Request $request) : RedirectResponse {
        $reservation = Reservation::where('id', '=', (int)$request->input('reservation_id'))->first();

        session()->remove('review');

        if($reservation) {
            $user = auth()->user();
            $ride = $reservation->getRide();
            $driver = $ride->getDriver();

            $review = Review::create([
                'user_id' => $user->id,
                'driver_id' => $driver->id,
                'reservation_id' => $reservation->id,
                'note' => (int)$request->input('note', 1),
                'comments' => $request->input('comments'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'is_active' => 1,
            ]);

            session()->put('review', $review->toArray());
            session()->save();
        }

        return response()->redirectToRoute('review_complete', ['reservation' => (int)$reservation->id]);
    }

    /**
     * Affichage
     *
     * @param Reservation $reservation
     * @return View
     */
    public function complete(Reservation $reservation) : View {

        return view('review.complete');
    }
}
