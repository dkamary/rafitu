<?php

namespace App\Http\Controllers;

use App\Models\PreReservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PreReservationAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        $actives = PreReservation::where('is_active', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        $inactives = PreReservation::where('is_active', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.prereservation.index', [
            'actives' => $actives,
            'inactives' => $inactives,
        ]);
    }

    public function edit(PreReservation $prereservation) : View {

        return view('admin.prereservation.edit', [
            'prereservation' => $prereservation,
        ]);
    }

    public function save(Request $request, PreReservation $prereservation) : RedirectResponse {
        $prereservation->is_active = (int)$request->input('is_active');
        $prereservation->save();

        session()->flash('success', "La pré-réservation a été mis à jour avec succès!");

        return response()->redirectToRoute('admin_prereservation_index');
    }
}
