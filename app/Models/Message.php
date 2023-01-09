<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = ['token', 'user_id', 'client_id', 'sender', 'date_sent', 'content', 'is_seen', 'is_new'];
    public $timestamps = false;

    protected $user;
    protected $client;

    public function seen() : self {
        $this->is_seen = 1;

        return $this;
    }

    public function isSeen() : bool {
        return ($this->is_seen == 1);
    }

    public function toArray()
    {
        $dateSent = new \DateTime($this->date_sent);

        return [
            'id' => (int)$this->id,
            'token' => $this->token,
            'user_id' => $this->user_id,
            'client_id' => $this->client_id,
            'sender' => $this->sender,
            'date_sent' => $this->displayDate(),
            'content' => $this->content,
            'is_seen' => $this->is_seen,
            'is_new' => $this->is_new,
        ];
    }

    public function getUser(bool $default = true) : ?User {
        if($this->user) return $this->user;

        $this->user = User::where('id', '=', (int)$this->user_id)->first();
        if(!$this->user && $default) {
            return new User([
                'firstname' => 'RAFITU',
            ]);
        }

        return $this->user;
    }

    public function getClient() : User {
        return $this->client ?: $this->client = User::where('id', '=', (int)$this->client_id)->first();
    }

    public function displayDate() : string {
        if(!$this->date_sent) return 'n/a';

        $date = new DateTime($this->date_sent);
        $now = new DateTime();
        $diff = $now->diff($date);
        if($diff->d < 1) {
            return 'Aujourd\'hui à ' . $date->format('H:i:s');
        } elseif($diff->d == 1) {
            return 'Hier à ' . $date->format('H:i:s');
        } elseif($diff->d == 2) {
            return 'Avant hier à ' . $date->format('H:i:s');
        } else {
            return $date->format('d/m/Y à H:i:s');
        }
    }
}
