<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $fillable = [
        'reservation_id', 'referrence_id', 'amount', 'payment_date', 'raw_data',
    ];
    public $timestamps = false;
}
