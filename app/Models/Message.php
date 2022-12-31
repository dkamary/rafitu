<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = ['token', 'user_id', 'client_id', 'sender', 'date_sent', 'content', 'is_seen', 'is_new'];
    public $timestamps = false;

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
}
