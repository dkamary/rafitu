<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_message';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'message', 'is_readed', 'sent_date',];
    public $timestamps = false;
}
