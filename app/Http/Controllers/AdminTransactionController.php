<?php

namespace App\Http\Controllers;

use App\Models\Managers\CommissionManager;
use App\Models\Managers\ParamManager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function paiements(Request $request) : View {
        return view('admin.transactions.paiements');
    }

    public function commissions(Request $request) : View {
        $parameter = ParamManager::getParameters();
        $todo = CommissionManager::getTodo();
        $done = CommissionManager::getDone();

        if($request->isMethod(Request::METHOD_GET)) {

            return view('admin.transactions.commissions', [
                'parameter' => $parameter,
                'todo' => $todo,
                'done' => $done,
            ]);
        }

        $parameter->com_longtrajet = $request->input('com_longtrajet');
        $parameter->com_quotidien = $request->input('com_quotidien');
        // $parameter->dist_longtrajet = $request->input('dist_longtrajet');

        $parameter->save();

        session()->flash('success', 'Paramètres des commissions mis à jour');

        return view('admin.transactions.commissions', [
            'parameter' => $parameter,
            'todo' => $todo,
            'done' => $done,
        ]);
    }

    public function remboursements() : View {
        return view('admin.transactions.remboursements');
    }

    public function modePaiements() : View {
        return view('admin.transactions.mode-de-paiement');
    }
}
