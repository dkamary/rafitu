<?php

namespace App\Http\Controllers;

use App\Models\Managers\AvatarManager;
use App\Models\Managers\MessengerManager;
use App\Models\Message;
use App\Models\Reservation;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if($request->isMethod(Request::METHOD_POST)) {
            $user->firstname = $request->input('firstname', $user->firstname);
            $user->lastname = $request->input('lastname', $user->lastname);
            $user->birthdate = $request->input('birthdate');
            $user->address_line1 = $request->input('address_line1');
            $user->address_line2 = $request->input('address_line2');
            $user->zip_code = $request->input('zip_code');
            $user->tel = $request->input('tel');
            $user->mobile = $request->input('mobile');
            $user->biography = $request->input('biography');
            if($avatar = AvatarManager::handleUpload($request, 'avatar', $user)) {
                dump($avatar);
                $user->avatar = $avatar;
            }
            $user->save();

            session()->flash('success', 'Vos informations ont été mis à jour avec succès!');
        }

        return view('dashboard.user', [
            'user' => $user,
        ]);
    }

    public function password(Request $request) : RedirectResponse {
        $user = User::where('id', '=', (int)$request->input('id'))->first();
        if(!$user) {
            session()->flash('warning', 'L\'utilisateur est introuvable!');

            return response()->redirectToRoute('dashboard_user');
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        session()->flash('success', 'Mot de passe mis à jour avec succès');

        return response()->redirectToRoute('dashboard_user');
    }

    public function reservations() : View {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', '=', (int)$user->id)
            ->orderBy('reservation_date', 'DESC')
            ->get();

        return view('dashboard.reservation', [
            'reservations' => $reservations,
        ]);
    }

    public function reservationShow(Reservation $reservation) : View {
        return view('', [
            'reservation' => $reservation,
        ]);
    }

    public function messengerIndex(){
        $user = Auth::user();
        $messages = MessengerManager::myMessages($user->id);

        return view('', [
            'messages' => $messages,
        ]);
    }

    public function messengerShow(string $token){
        $messages = MessengerManager::myMessagesByToken($token);

        return view('', [
            'messages' => $messages,
        ]);
    }

    public function messengerLast(){}

    public function messengerSend(Request $request, string $token){
        $user = Auth::user();
        $token = $request->input('token', md5($user->id .'-'.$request->input('receiver_id').time()));
        $data = [
            'token' => $token,
            'sender_id' => (int)$user->id,
            'receiver_id' => (int)$request->input('receiver_id'),
            'date_sent' => date('Y-m-d H:i:s'),
            'content' => $request->input('content'),
            'is_seen' => 0,
        ];
        $message = Message::create($data);
        $data['id'] = $message->id;

        return response()->json([
            'token' => $token,
            'message' => $data,
        ]);
    }

    public function vehicleIndex(){
        $user = Auth::user();
        $vehicles = Vehicule::where('is_active', '=', 1)
            ->where('owner_id', '=', $user->id)
            ->get();

        return view('', [
            'vehicles' => $vehicles,
        ]);
    }

    public function vehicleAdd(Request $request){
        $user = Auth::user();

        if($request->isMethod(Request::METHOD_POST)) {
            $vehicle = Vehicule::create([
                'owner_id' => $user->id,
                'registration' => $request->input('registration'),
                'country_id' => $request->input('country_id'),
                'vehicle_brand_id' => $request->input('vehicle_brand_id'),
                'vehicle_model_id' => $request->input('vehicle_model_id'),
                'allow_animal' => $request->input('allow_animal'),
                'allow_smoker' => $request->input('allow_smoker'),
                'seats_available' => $request->input('seats_available'),
                'is_active' => 1,
            ]);

            session()->flash('success', 'Véhicule ajouté avec succès!');
        }

        return view('', [
            'user' => $user,
            'vehicle' => new Vehicule(['is_active' => 1,]),
        ]);
    }

    public function vehicleEdit(Request $request, Vehicule $vehicule){
        $user = Auth::user();
        if($vehicule->owner_id != $user->id) {
            return view('', []);
        }

        if($request->isMethod(Request::METHOD_POST)) {
            $vehicule->registration = $request->input('registration');
            $vehicule->country_id = $request->input('country_id');
            $vehicule->vehicle_brand_id = $request->input('vehicle_brand_id');
            $vehicule->vehicle_model_id = $request->input('vehicle_model_id');
            $vehicule->allow_animal = $request->input('allow_animal');
            $vehicule->allow_smoker = $request->input('allow_smoker');
            $vehicule->seats_available = $request->input('seats_available');

            $vehicule->save();

            session()->flash('success', 'Véhicule mis à jour avec succès!');
        }

        return view('', [
            'user' => $user,
            'vehicle' => $vehicule,
        ]);
    }

    public function vehicleRemove(Request $request){
        $user = Auth::user();
        $vehicle= Vehicule::where('id', '=', (int)$request->input('id'))
            ->first();
        if(!$vehicle) {

            return response()->json([
                'done' => false,
                'error' => true,
                'message' => 'Le vehicule demandé est introuvable',
            ], 404);
        }

        if($vehicle->owner_id != $user->id) {

            return response()->json([
                'done' => false,
                'error' => true,
                'message' => 'Le véhicule que vous tenter d\'effacer ne vous appartient pas',
            ]);
        }

        $vehicle->remove();

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => 'Le vehicule a été correctement supprimé',
        ]);
    }

}
