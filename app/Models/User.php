<?php

namespace App\Models;

use App\Models\Managers\AvatarManager;
use DateTime;
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
    protected $_town = null;

    public function __toString()
    {
        return sprintf('%s %s', $this->firstname, $this->lastname);
    }

    public function getAvatar(string $size = AvatarManager::SIZE_SMALL) : ?string {
        if(!$this->avatar) return null;
        $info = pathinfo($this->avatar);
        $filename = $info['filename'] . '-' . $size .'.' . $info['extension'];
        if(is_file(AVATAR_DIR . $filename)) return $filename;
        else return $this->avatar;
    }

    public function getBirthdate(?string $format = 'd/m/Y') {
        if(is_null($this->birthdate)) return null;
        $date = new DateTime($this->birthdate);

        if(is_null($format)) {
            return $date;
        }

        return $date->format($format);
    }

    public function getFullname() : string {
        $fullname = '';
        $fullname .= trim($this->firstname);
        $fullname .= strlen(trim($this->lastname)) > 0 ? ' ' .trim($this->lastname) : '';

        return $fullname;
    }

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
