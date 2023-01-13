<?php

// Functions

use App\Models\User;

if(!function_exists('get_avatar')) {
    /**
     * User Avatar
     *
     * @param User|null $user
     * @return string
     */
    function get_avatar(?User $user) {
        if(!$user) return asset('avatars/user-01.svg');

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
