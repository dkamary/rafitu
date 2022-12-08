<?php

namespace App\Models\Managers;

use Google\Client;

class GoogleOAuthManager {
    public static function getClient() : Client {
        $client = new Client();

        $client->setApplicationName(config('app.name'));
        $client->setClientId(config('google.oauth.client.key'));
        $client->setClientSecret(config('google.oauth.client.secret'));
        // $client->addScope(Oauth2::USERINFO_PROFILE);
        $client->addScope('email');
        $client->addScope('profile');

        return $client;
    }
}
