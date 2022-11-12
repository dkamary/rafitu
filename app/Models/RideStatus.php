<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideStatus extends Model
{
    protected $table = 'ride_status';
    protected $primaryKey = 'id';
    protected $fillable = ['label', 'is_active',];
    public $timestamps = false;
}
