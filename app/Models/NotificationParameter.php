<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationParameter extends Model
{
    protected $table = 'notification_parameter';
    protected $primaryKey = 'id';
    protected $fillable = ['admin_email', 'contact_email', 'reservation_email', 'tel',];
    public $timestamps = false;

    public static function getDefault() : NotificationParameter {

        return new NotificationParameter([
            'admin_email' => 'donatkamary@gmail.com',
            'reservation_email' => 'donatkamary@gmail.com',
            'contact_email' => 'donatkamary@gmail.com',
            'tel' => '+1 00 00 00 00',
        ]);
    }

    public function getAdminEmail() : ?string {
        return $this->admin_email;
    }

    public function getReservationEmail() : ?string {
        return $this->reservation_email;
    }

    public function getContactEmail() : ?string {
        return $this->contact_email;
    }

    public function getTel() : ?string {
        return $this->tel;
    }

}
