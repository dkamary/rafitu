<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehiculeAdminController extends Controller
{
    public function index() : View {
        return view('');
    }

    public function edit(Vehicule $vehicule) : View {
        return view('');
    }

    public function remove(Vehicule $vehicule) : RedirectResponse {
        return response()->redirectToRoute('');
    }
}
