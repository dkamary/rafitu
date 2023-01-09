<?php

namespace App\Models\Managers;

use App\Models\UserConnected;

class UserManager {
    public static function isset(): bool {
        return false;
    }

    public static function IamConnected() : ?UserConnected {
        $user = auth()->user();
        if($user) {
            $IamConnected = UserConnected::where('user_id', '=', (int)$user->id)->first();
            if(!$IamConnected) {
                $IamConnected = new UserConnected();
            }
            $IamConnected
                ->connected($user)
                ->save();

            return $IamConnected;
        }

        return null;
    }

    public static function isConnected(int $userId, int $inactivity = 120) : bool {
        /**
         * @var UserConnected $userConnected
         */
        $userConnected = UserConnected::where('user_id', '=', $userId)->first();
        if(!$userConnected) return false;

        return $userConnected->isConnected($inactivity);
    }
}
