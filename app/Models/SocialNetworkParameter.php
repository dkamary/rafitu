<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetworkParameter extends Model
{
    protected $table = 'social_network_parameter';
    protected $primaryKey = 'id';
    protected $fillable = ['facebook', 'instagram', 'twitter', 'linkedin'];
    public $timestamps = false;

    public function hasFacebook() : bool {
        if(is_null($this->facebook)) return false;
        if(strlen(trim($this->facebook)) < 5) return false;

        return true;
    }

    public function hasInstagram() : bool {
        if(is_null($this->instagram)) return false;
        if(strlen(trim($this->instagram)) < 5) return false;

        return true;
    }

    public function hasTwitter() : bool {
        if(is_null($this->twitter)) return false;
        if(strlen(trim($this->twitter)) < 5) return false;

        return true;
    }

    public function hasLinkedin() : bool {
        if(is_null($this->linkedin)) return false;
        if(strlen(trim($this->linkedin)) < 5) return false;

        return true;
    }
}
