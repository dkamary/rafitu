<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = ['token', 'sender_id', 'receiver_id', 'date_sent', 'content', 'is_seen'];
    public $timestamps = false;

    public function isSeen() : bool {
        return ($this->is_seen == 1);
    }
}
