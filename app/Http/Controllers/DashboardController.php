<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() : View {
        return view('index');
    }

    public function user(Request $request) : View {
        $user = Auth::user();
        if($request->getMethod() == Request::METHOD_POST) {
            $user->firstname = $request->input('firstname', $user->firstname);
            $user->lastname = $request->input('lastname', $user->lastname);
            $user->birthdate = $request->input('birthdate');
            $user->address_line1 = $request->input('address_line1');
            $user->address_line2 = $request->input('address_line2');
            $user->zip_code = $request->input('zip_code');
            $user->tel = $request->input('tel');
            $user->mobile = $request->input('mobile');
            $user->biography = $request->input('biography');
            if($avatar = $request->file('avatar')) {
                $filename = uniqid('avatar-') . '.' .$avatar->getFileInfo()->getExtension();
                $avatar->move(public_path('avatars/') . $filename);
                $user->avatar = $filename;
            }
            $user->save();

            session()->flash('success', 'Vos informations ont été mis à jour avec succès!');
        }

        return view('dashboard.user', [
            'user' => $user,
        ]);
    }
}
