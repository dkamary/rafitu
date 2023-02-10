<?php

namespace App\Http\Controllers;

use App\Models\Managers\SocialNetworkManager;
use App\Models\SocialNetworkParameter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialNetworkParameterAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        $parameter = SocialNetworkManager::getParameter();

        return view('admin.social-network.index', [
            'parameter' => $parameter,
        ]);
    }

    public function save(Request $request) : RedirectResponse {
        $parameter = SocialNetworkManager::getParameter();
        $parameter->facebook = $request->input('facebook');
        $parameter->instagram = $request->input('instagram');
        $parameter->twitter = $request->input('twitter');
        $parameter->linkedin = $request->input('linkedin');
        $parameter->save();

        session()->flash('success', 'Paramètre mis à jour avec succès');

        return response()->redirectToRoute('admin_social_network_parameter_index');
    }
}
