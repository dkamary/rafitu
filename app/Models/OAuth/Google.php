<?php

namespace App\Models\OAuth;

use Exception;

class Google
{
    public static function getAuthorizationPage(): string
    {
        $state = bin2hex(random_bytes(16));
        $params = [
            'response_type' => 'code',
            'client_id' => config('google.oauth.client.key'),
            'redirect_uri' => route('oauth_success'),
            'scope' => 'openid email',
            'state' => $state,
        ];
        session()->put('state', $state);
        $uri = config('google.oauth.authorize.url') . http_build_query($params);

        return $uri;
    }

    public static function getToken(string $code, string $state, string $redirectUri) : array
    {
        if ($state != session()->get('state')) {
            throw new Exception(sprintf('Invalid State. state: `%s` <> `%s`', $state, session()->get('state')));
        }

        $url = config('google.oauth.authorize.token');
        $postfields = [
            'grant_type' => 'authorization_code',
            'client_id' => config('google.oauth.client.key'),
            'client_secret' => config('google.oauth.client.secret'),
            'redirect_uri' => $redirectUri,
            'code' => $code,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($postfields),
        ]);
        $result = curl_exec($curl);

        if(!$result) {
            throw new Exception(sprintf('Unable to get token for code: `%s`, state: `%s`. Error: %s', $code, $state, curl_error($curl)));
        }

        $data = json_decode($result, true);

        return $data;
    }

    public static function getUserInfo(string $token)
    {
        $url = config('google.oauth.user.info');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $token),
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            sprintf('Authorization: Bearer %s', $token),
        ]);
        $result = curl_exec($curl);

        if (!$result) {
            throw new Exception(sprintf('Unable to request `%s`: %s', $url, curl_error($curl)));
        }

        return $result;
    }
}
