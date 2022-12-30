<?php

namespace App\Http\Controllers;

use App\Models\NotificationParameter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactAdminController extends Controller
{
    public function index(Request $request) : View {
        $parameter = NotificationParameter::where('id', '=', 1)->first();
        if(!$parameter) {
            $parameter = NotificationParameter::getDefault();
            $parameter->save();
        }

        if($request->isMethod(Request::METHOD_POST)) {
            $parameter->admin_email = $request->input('admin_email');
            $parameter->reservation_email = $request->input('reservation_email');
            $parameter->contact_email = $request->input('contact_email');
            $parameter->tel = $request->input('tel');

            $parameter->save();

            $request->session()->flash('success', 'Les paramètres ont été mis à jour avec succès');
        }

        return view('admin.contact.contact-parameter', [
            'parameter' => $parameter,
        ]);
    }
}
