<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideItinerary extends Model
{
    protected $table = 'ride_itinerary';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ride_id', 'lat', 'lng',
        'created_at', 'updated_at',
    ];
    public $timestamp = false;
}
