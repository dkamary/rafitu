<?php

namespace App\Http\Controllers;

use App\Models\Managers\PaypalManager;
use App\Models\Order;
use App\Models\OrderLink;
use App\Models\Payments\CinetPay\CinetPay;
use App\Models\Reservation;
use App\Models\Transactions\Result;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payReservation(Request $request) {

    }

    public function payReservationPaypal(Request $request)
    {
        //
    }

    public function paySuccess(Request $request)
    {
        //
    }

    public function payCancel(Request $request)
    {
        //
    }

    public function notification(Request $request)
    {

    }
}
