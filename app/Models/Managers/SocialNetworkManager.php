<?php

namespace App\Models\Managers;

use App\Models\SocialNetworkParameter;

class SocialNetworkManager {
    private static $_socialParameter;

    public static function getParameter() : SocialNetworkParameter {
        self::$_socialParameter = SocialNetworkParameter::where('id', '=', 1)->first();
        if(self::$_socialParameter) return self::$_socialParameter;

        return new SocialNetworkParameter([
            'facebook' => '#',
            'instagram' => '#',
            'twitter' => '#',
            'linkedin' => '#',
        ]);
    }
}
