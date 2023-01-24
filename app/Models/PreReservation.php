<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreReservation extends Model {
    protected $table = 'prereservation';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fullname', 'email',
        'departure_label', 'arrival_label',
        'reservation_date', 'reservation_time', 'passenger',
        'created_at', 'is_active'
    ];
    public $timestamps = false;

    public function isActive() : bool {
        return $this->is_active == 1;
    }
}
