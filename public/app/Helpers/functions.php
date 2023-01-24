<?php

// Functions

use App\Models\RideStatus;
use App\Models\User;

if(!function_exists('get_avatar')) {
    /**
     * User Avatar
     *
     * @param int|User|null $user
     * @return string
     */
    function get_avatar($user) {
        if(!$user) return asset('avatars/user-01.svg');
        if(is_numeric($user)) {
            $user = User::where('id', '=', (int)$user)->first();
            if(!$user) return asset('avatars/user-01.svg');
        }

        $avatar = $user->getAvatar();
        $userAvatar = $avatar;
        if($avatar) {
            if(strpos($avatar, 'http') !== false) {
                $userAvatar = $avatar;
            } else {
                $userAvatar = asset('avatars/' . $avatar);
            }
        } else {
            $userAvatar = asset('avatars/user-01.svg');
        }

        return $userAvatar;
    }

}

if(!function_exists('display_date')) {

    /**
     * Afficher la date
     *
     * @param string|null $datetime
     * @param string $format
     * @return string
     */
    function display_date(?string $datetime, string $format = 'H:i:s') : string {
        if(!$datetime) return 'n/a';

        $date = new DateTime($datetime);
        $now = new DateTime();
        $diff = $now->diff($date);
        if($diff->d < 1) {
            return 'Aujourd\'hui à ' . $date->format($format);
        } elseif($diff->d == 1) {
            return 'Hier à ' . $date->format($format);
        } elseif($diff->d == 2) {
            return 'Avant hier à ' . $date->format($format);
        } else {
            return $date->format('d/m/Y à ' . $format);
        }
    }
}

if(!function_exists('show_date')) {

    function show_date(?string $datetime, $format = 'd/m/Y H:i') : string {
        if(!$datetime) return 'n/a';

        $date = new DateTime($datetime);

        return $date->format($format);
    }
}

if(!function_exists('is_mobile')) {

    function is_mobile() : bool {

        return preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        );
    }

}


if(!function_exists('ride_status')) {

    function ride_status(int $status, string $default = 'n/a') : string {

        return RideStatus::getStatus($status, $default);
    }

}