<?php

namespace App\Http\Controllers;

use App\Models\Managers\ParamManager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RideAdminController extends Controller
{
    public function index():  View {
        return view('');
    }

    public function parameters(Request $request) : View {
        $parameters = ParamManager::getParameters();
        if($request->isMethod(Request::METHOD_POST)) {
            $parameters->dist_longtrajet = (int)$request->input('dist_longtrajet', 30000);
            $parameters->save();

            session()->flash('success', 'Paramètre mis à jour');
        }

        return view('admin.ride.parameters', [
            'parameters' => $parameters,
        ]);
    }
}
