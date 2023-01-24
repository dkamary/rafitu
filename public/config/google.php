<?php

return [
    'oauth' => [
        'authorize' => [
            'url' => env('GOOGLE_OAUTH_AUTHORIZE_URL'),
            'token' => env('GOOGLE_OAUTH_AUTHORIZE_TOKEN'),
        ],
        'client' => [
            'key' => env('GOOGLE_OAUTH_CLIENT_KEY'),
            'secret' => env('GOOGLE_OAUTH_CLIENT_SECRET'),
        ],
        'user' => [
            'info' => env('GOOGLE_OAUHT_USER_INFO'),
        ]
    ],
    'maps' => [
        'api' => [
            'key' => env('GOOGLE_MAPS_API_KEY'),
        ],
        'directions' => 'https://maps.googleapis.com/maps/api/directions/json?origin=%s&destination=%s&mode=driving&alternatives=true&key=AIzaSyC3x7T4SRBlh_Tx_vA-R531lPxjVNTbSlY'
    ]
];
