<?php

namespace App\Http\Controllers;

use App\Models\Managers\AvatarManager;
use App\Models\Managers\MessengerManager;
use App\Models\Message;
use App\Models\Reservation;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() : View {
        $user = Auth::user();

        $messageCount = MessengerManager::myMessagesCount($user->id);
        $reservationCount = Reservation::where('user_id', '=', (int)$user->id)->count();
        $unpaidCount = DB::table('order')
            ->select('order.id')
            ->join('reservation', 'order.reservation_id', '=', 'reservation.id')
            ->where('reservation.user_id', '=', (int)$user->id)
            ->where('order.intent', 'LIKE', 'ORDER')
            ->where('order.status', 'LIKE', 'CREATED')
            ->count();

        return view('dashboard.index', [
            'messages' => $messageCount,
            'reservations' => $reservationCount,
            'unpaids' => $unpaidCount,
        ]);
    }

    public function user(Request $request) : View {
        /**
         * @var User $user
         */
        $user = Auth::user();
        if($request->isMethod(Request::METHOD_POST)) {
            $user->firstname = $request->input('firstname', $user->firstname);
            $user->lastname = $request->input('lastname', $user->lastname);
            $user->birthdate = $request->input('birthdate');
            $user->address_line1 = $request->input('address_line1');
            $user->address_line2 = $request->input('address_line2');
            // $user->zip_code = $request->input('zip_code');
            $user->tel = $request->input('tel');
            $user->mobile = $request->input('mobile');
            $user->biography = $request->input('biography');
            if($avatar = AvatarManager::handleUpload($request, 'avatar', $user)) {
                // dump($avatar);
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

        $result = DB::table('reservation')
            ->select(['id'])
            ->where('user_id', '=', (int)$user->id)
            ->whereRaw('(`status` IS NULL OR `status` not like ?)', [Reservation::STATUS_CANCEL])
            ->get();

        $ids = [];
        foreach($result as $r) {
            $ids[] = (int)$r->id;
        }

        $reservations = Reservation::whereIn('id', $ids)
            ->orderBy('reservation_date', 'DESC')
            ->get();

        return view('dashboard.reservation.index', [
            'reservations' => $reservations,
        ]);
    }

    public function reservationShow(Reservation $reservation) : View {
        return view('dashboard.reservation.show', [
            'reservation' => $reservation,
            'parameters' => [
                'origin' => null,
                'destination' => null,
            ],
        ]);
    }

    public function messengerIndex(){
        /**
         * @var User $user
         */
        $user = Auth::user();

        // if($user->isAdmin()) {
        //     return $this->messengerAdminIndex();
        // }

        $messages = MessengerManager::myMessagesPreview($user->id);

        return view('dashboard.message.index', [
            'messages' => $messages,
        ]);
    }

    public function messengerShow(string $token){
        /**
         * @var User $user
         */
        $user = Auth::user();

        $last = MessengerManager::lastMessageByToken($token);

        if($last && !is_null($last->user_id)) {
            $messages = MessengerManager::myMessagesByToken($token);
            $last = $messages->last();

            return view('dashboard.message.show', [
                'messages' => $messages,
                'last' => $last,
                'conversation' => MessengerManager::getConversationInfo($token, $user),
            ]);
        }

        // if($user->isAdmin()) {
        //     return $this->messengerAdminShow($token);
        // }

        $messages = MessengerManager::myMessagesByToken($token);
        $last = $messages->last();

        return view('dashboard.message.show', [
            'messages' => $messages,
            'last' => $last,
            'conversation' => MessengerManager::getConversationInfo($token, $user),
        ]);
    }

    public function messengerAdminIndex(){
        $user = Auth::user();
        $messages = MessengerManager::myAdminMessagesPreview((int)$user->id);

        return view('dashboard.admin-message.index', [
            'messages' => $messages,
        ]);
    }

    public function messengerAdminShow(string $token){
        $messages = MessengerManager::myMessagesByToken($token);
        $last = $messages->last();
        dd([]);

        return view('dashboard.admin-message.show', [
            'messages' => $messages,
            'last' => $last,
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

    public function messengerRemove(Request $request) : RedirectResponse {
        $token = $request->input('token');
        $affected = DB::table('message')
            ->where('token', 'like', $token)
            ->update([
                'is_deleted' => 1
            ]);

        session()->flash('success', 'La conversation a été effacée');

        return response()->redirectToRoute('dashboard_messenger_index');
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
