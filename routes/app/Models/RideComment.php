<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideComment extends Model
{
    protected $table = 'ride_comment';
    protected $primaryKey = 'id';
    protected $fillable = ['ride_id', 'user_id', 'is_like', 'is_dislike', 'note', 'content',];
    public $timestamps = false;
}
