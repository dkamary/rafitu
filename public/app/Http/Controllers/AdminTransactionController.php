<?php

namespace App\Http\Controllers;

use App\Models\Managers\CommissionManager;
use App\Models\Managers\ParamManager;
use Illuminate\Http\RedirectResponse;
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
        $todo = CommissionManager::unpaidCommission();
        $done = CommissionManager::paidCommission();

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

    public function modePaiements(Request $request) : View {
        $parameter = ParamManager::getParameters();

        return view('admin.transactions.mode-de-paiement', [
            'parameter' =>$parameter,
        ]);
    }

    public function updateCinetPay(Request $request) : RedirectResponse {
        $parameter = ParamManager::getParameters();

        $parameter->cinetpay_api = $request->input('cinetpay_api');
        $parameter->cinetpay_currency = $request->input('cinetpay_currency');
        $parameter->cinetpay_lang = $request->input('cinetpay_lang');
        $parameter->cinetpay_mode = $request->input('cinetpay_mode');
        $parameter->cinetpay_secret = $request->input('cinetpay_secret');
        $parameter->cinetpay_site_id = $request->input('cinetpay_site_id');

        $parameter->save();

        session()->flash('success', 'Les paramètres du mode de paiement <strong>CINETPAY</strong> ont été mis à jour!');

        return response()->redirectToRoute('transaction_mode_de_paiements');
    }

    public function updatePaypal(Request $request) : RedirectResponse {
        $parameter = ParamManager::getParameters();

        $parameter->paypal_account = $request->input('paypal_account');
        $parameter->paypal_client_id = $request->input('paypal_client_id');
        $parameter->paypal_mode = $request->input('paypal_mode');
        $parameter->paypal_secret = $request->input('paypal_secret');
        $parameter->paypal_plateform_partner_app = $request->input('paypal_plateform_partner_app');
        $parameter->paypal_bn_code = $request->input('paypal_bn_code');

        $parameter->save();

        session()->flash('success', 'Les paramètres du mode de paiement <strong>PAYPAL</strong> ont été mis à jour!');

        return response()->redirectToRoute('transaction_mode_de_paiements');
    }
}
