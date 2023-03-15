<?php

namespace App\Http\Controllers;

use App\Models\CommissionPayment;
use App\Models\Managers\CommissionManager;
use App\Models\Managers\ParamManager;
use Illuminate\Http\JsonResponse;
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
        $parameter->heure_execution = (int)$request->input('heure_execution', 18000);

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

    public function commissions_pay(Request $request) : JsonResponse {
        $id = (int)$request->input('id');
        $commissionPayment = CommissionPayment::where('id', '=', $id)->first();

        if(!$commissionPayment) {

            return response()->json([
                'done' => false,
                'message' => 'La commission est introuvable',
            ]);
        }

        if(!CommissionManager::executePayment($commissionPayment)) {

            return response()->json([
                'done' => false,
                'message' => 'Echec lors de la transaction',
            ]);
        }

        return response()->json([
            'done' => true,
            'message' => 'Le paiement a été effectué avec succès',
        ]);
    }
}
