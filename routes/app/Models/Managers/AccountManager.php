<?php

namespace App\Models\Managers;

use App\Models\User;

class AccountManager {
    public static function find(string $email) : ?User {
        $user = User::where('email', 'LIKE', $email)->first();

        return $user;
    }

    public static function createUser(array $data) : ?User {
        $user = User::create([
            'login' => $data['email'],
            'email' => $data['email'],
            'password' => $data['password'] ?? bcrypt(uniqid()),
            'user_type_id' => (int)$data['user_type_id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            // A compléter
        ]);

        return $user;
    }
}
