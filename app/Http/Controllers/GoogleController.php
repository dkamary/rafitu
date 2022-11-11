<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use App\Models\UserStatus;
use Google\Service\Oauth2;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Managers\AccountManager;
use App\Models\Managers\GoogleOAuthManager;

class GoogleController extends Controller
{
    public function auth(Request $request) : RedirectResponse {
        $client = GoogleOAuthManager::getClient();

        $client->setRedirectUri(route('auth_google_redirect'));
        $url = $client->createAuthUrl();

        if($route = $request->input('intent')) {
            session()->put('intent_route', $route);
        }

        return response()->redirectTo($url);
    }

    public function redirect(Request $request) : RedirectResponse {
        $code = $request->input('code');
        if(!$code) {
            session()->flash('error', 'Une erreur est survenue lors de l\'authentification à Google');

            return response()->redirectToRoute('login');
        }

        $client = GoogleOAuthManager::getClient();
        $client->setRedirectUri(route('auth_google_redirect'));
        $token = $client->fetchAccessTokenWithAuthCode($code);
        $client->setAccessToken($token['access_token']);
        session()->put('access_token', $token['access_token'] ?? null);

        $oauth2 = new Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        $user = AccountManager::find($userInfo->email);

        if(!$user) {
            $userType = UserType::where('id', '=', 4)->first();
            if(!$userType) {
                $userType = new UserType(['label' => 'Passage']);
                $userType->save();
                $userType->refresh();
            }

            $userStatus= UserStatus::where('id', '=', 1)->first();
            if(!$userStatus) {
                $userStatus = new UserStatus(['label' => 'Actif']);
                $userStatus->save();
                $userType->refresh();
            }

            $user = User::create([
                'login' => $userInfo->email,
                'email' => $userInfo->email,
                'password' => bcrypt(uniqid()),
                'user_type_id' => (int)$userType->id,
                'firstname' => $userInfo->givenName,
                'lastname' => $userInfo->familyName,
                'avatar' => $userInfo->picture,
                'user_status_id' => (int)$userStatus->id,
            ]);
        }

        Auth::login($user);

        session()->flash('success', sprintf('Vous êtes connecté en tant que <strong>%s</strong>', $userInfo->name));

        $route = session()->get('intent_route', 'home');

        return response()->redirectToRoute($route);
    }

    public function directions(Request $request) : JsonResponse {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        $curl = curl_init();
        $url = sprintf(config('google.maps.directions'), urlencode($origin), urlencode($destination));
        curl_setopt_array($curl, [
            CURLOPT_URL=> $url,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $result = curl_exec($curl);
        if(!$result) {
            return response()->json([
                'error' => curl_error($curl),
            ]);
        }
        list($originLat, $originLng) = explode(', ', $origin);
        list($destinationLat, $destinationLng) = explode(', ', $destination);

        return response()->json([
            'origin' => ['lat' => $originLat, 'lng' => $originLng,],
            'destination' => ['lat' => $destinationLat, 'lng' => $destinationLng,],
            'result' => json_decode($result, true),
        ]);
    }
}
