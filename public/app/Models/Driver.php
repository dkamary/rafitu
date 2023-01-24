<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'driver';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'smoker', 'animal', 'woman_only', 'pass_vaccinal', 'talk', 'music',];
    // public $timestamps = false;

    protected $user;

    public function getUser() : ?User {
        if($this->user) return $this->user;

        return $this->user = User::where('id', '=', (int)$this->user_id)->first();
    }

    public function likeSmoker() : bool {
        return $this->smoker == 1;
    }

    public function likeAnimal() : bool {
        return $this->animal == 1;
    }

    public function likeWomanOnly() : bool {
        return $this->woman_only == 1;
    }

    public function likePassVaccinal() : bool {
        return $this->pass_vaccinal == 1;
    }

    public function likeTalk() : bool {
        return $this->talk == 1;
    }

    public function likeMusic() : bool {
        return $this->music == 1;
    }
}
