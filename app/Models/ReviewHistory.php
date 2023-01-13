<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewHistory extends Model
{
    const STATUS_SENT = 'sent';

    protected $table = 'review_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'reservation_id', 'status',
        'created_at',
    ];
    public $timestamps = false;

    protected $reservation;

    public function getReservation() : ?Reservation {
        return $this->reservation ?: $this->reservation = Reservation::where('id', '=', (int)$this->reservation_id)->first();
    }
}
