<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'driver_id', 'reservation_id',
        'note', 'comments',
        'created_at', 'updated_at',
        'is_active',
    ];
    public $timestamps = false;

    protected $user;
    protected $driver;
    protected $reservation;

    public function getUser(): ?User {
        return $this->user ?: $this->user = User::where('id', '=', (int)$this->user_id)->first();
    }

    public function getDriver(): ?User {
        return $this->driver ?: $this->driver = User::where('id', '=', (int)$this->driver_id)->first();
    }

    public function getReservation(): ?Reservation {
        return $this->reservation ?: $this->reservation = Reservation::where('id', '=', (int)$this->reservation_id)->first();
    }

    public function isActive() : bool {
        return $this->is_active == 1;
    }

    public function getUserName() : string {
        $user = $this->getUser();
        return sprintf('<a href="%s">%s</a>', route('admin_user_edit', ['user' => $this->user_id]), $user ? $user->getFullname() : '&hellip;');
    }
}
