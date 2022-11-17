<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        $users = User::where('user_status_id', '=', 1)
            ->orderBy('firstname')
            ->orderBy('lastname')
            ->paginate(50);

        return view('admin.users.index', ['users' => $users]);
    }

    public function create(Request $request) {
        if($request->getMethod() != Request::METHOD_POST) {
            return view('admin.users.set', [
                'user' => new User(),
                'towns' => [],
                'countries' => [],
            ]);
        }

        $user = User::create([
            'login' => $request->input('email'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'user_type_id' => $request->input('user_type_id'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'address_line1' => $request->input('address_line1'),
            'address_line2' => $request->input('address_line2'),
            'zip_code' => $request->input('zip_code'),
            'town_id' => $request->input('town_id'),
            'country_id' => $request->input('country_id'),
            // 'language_id' => $request->input('address_line2'),
            'sexe_id' => $request->input('sexe_id'),
            'birthdate' => $request->input('birthdate'),
            'tel' => $request->input('tel'),
            'mobile' => $request->input('mobile'),
            'biography' => $request->input('biography'),
            'user_status_id' => 1,
        ]);

        session()->flash('success', 'Nouvel utilisateur créé!');

        return response()->redirectToRoute('admin_user_edit', ['user' => $user,]);
    }

    public function edit(Request $request, User $user) {
        if($request->getMethod() != Request::METHOD_POST) {
            return view('admin.users.set', [
                'user' => $user,
                'towns' => [],
                'countries' => [],
            ]);
        }

        $user->user_type_id = $request->input('user_type_id');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->zip_code = $request->input('zip_code');
        $user->town_id = $request->input('town_id');
        $user->country_id = $request->input('country_id');
        $user->sexe_id = $request->input('sexe_id');
        $user->birthdate = $request->input('birthdate');
        $user->tel = $request->input('tel');
        $user->mobile = $request->input('mobile');
        $user->biography = $request->input('biography');
        if(is_null($user->login)) {
            $user->login = $user->email;
        }
        $user->save();

        session()->flash('success', 'Utilisateur mis à jour!');

        return response()->redirectToRoute('admin_user_edit', ['user' => $user]);
    }

    public function deactivate(User $user) : RedirectResponse {
        $user->user_status_id = 2;
        $user->save();

        session()->flash('success', 'Utilisateur désactivé!');

        return response()->redirectToRoute('admin_user_index');
    }

    public function updatePassword(Request $request) : RedirectResponse {
        $user = User::where('id', '=', (int)$request->input('id'))->first();
        if(!$user) throw new NotFoundHttpException('Utilisateur introuvable');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        session()->flash('success', 'Mot de passe mis à jour avec succès!');

        return response()->redirectToRoute('admin_user_edit', ['user' => $user]);
    }
}
