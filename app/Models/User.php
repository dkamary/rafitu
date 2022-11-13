<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'login', 'email', 'password', 'user_type_id', 'firstname', 'lastname',
        'address_line1', 'address_line2', 'zip_code', 'town_id', 'country_id', 'language_id',
        'sexe_id', 'birthdate', 'tel', 'mobile', 'biography', 'avatar',
        'identification_number', 'identification_type_id', 'identification_release_place', 'identification_date',
        'user_status_id',
        'token',
    ];
    public $timestamp = false;
    protected $_userType = null;
    protected $_userStatus = null;

    public function isAdmin() : bool {
        $userType = $this->getUserType();
        if(!$userType) return false;

        return $userType->isAdmin();
    }

    public function getUserType() : ?UserType {
        if($this->_userType) return $this->_userType;

        $this->_userType = UserType::where('id', '=', (int)$this->user_type_id)->first();

        return $this->_userType;
    }

    public function getUserTypeName() : ?string {
        return UserType::getUserTypeName((int)$this->user_type_id);
    }

    public function getUserStatus() :?UserStatus {
        if($this->_userStatus) return $this->_userStatus;

        $this->_userStatus = UserStatus::where('id', '=', (int)$this->user_status_id)->first();

        return $this->_userStatus;
    }

    public static function createEmptyUser() : User {
        return new User();
    }
}
