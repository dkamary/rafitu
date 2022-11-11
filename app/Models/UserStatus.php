<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $table = 'user_status';
    protected $primaryKey = 'id';
    protected $fillable = ['label', 'is_active',];
    public $timestamp = false;
}
