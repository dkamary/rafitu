<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = 'ride';
    protected $primaryKey = 'id';
    protected $fillable = [
        'owner_id', 'vehicle_id', 'driver_id',
        'departure_label', 'departure_date', 'departure_position_long', 'departure_position_lat',
        'arrival_label', 'arrival_date', 'arrival_position_long', 'arrival_position_lat',
        'seats_available', 'woman_only', 'price',
        'ride_status_id',
        'created_at', 'updated_at',
    ];
    public $timestamp = false;
}
