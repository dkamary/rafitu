<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class UserConnected extends Model
{
    protected $table = 'user_connected';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'last_connection',];
    public $timestamps = false;

    protected $user;

    public function getUser() : ?User {
        return $this->user ?: $this->user = User::where('id', '=', (int)$this->user_id)->first();
    }

    public function getLastConnection() : ?DateTime {
        if(!$this->last_connection) return null;

        return new DateTime($this->last_connection);
    }

    public function connected(?User $user = null) : self {
        if($user) $this->user_id = (int)$user->id;
        $this->last_connection = date('Y-m-d H:i:s');

        return $this;
    }

    public function isConnected(int $inactivity = 120) : bool {
        $user = $this->getUser();
        if(!$user) return false;

        $lastConnection = $this->getLastConnection();
        if(!$lastConnection) return false;

        $diff = $lastConnection->diff(new DateTime(), true);
        $seconds = ($diff->h * 3600) + ($diff->i * 60) + $diff->s;

        return $seconds < $inactivity;
    }
}
