<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = ['token', 'user_id', 'client_id', 'sender', 'date_sent', 'content', 'is_seen', 'is_new'];
    public $timestamps = false;

    protected $user;
    protected $client;

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
            'date_sent' => $dateSent->format('d/m/Y H:i:s'),
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
}
