<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationParameter extends Model
{
    protected $table = 'notification_parameter';
    protected $primaryKey = 'id';
    protected $fillable = ['admin_email', 'tel',];
    public $timestamps = false;

    public static function getDefault() : NotificationParameter {

        return new NotificationParameter([
            'admin_email' => 'donatkamary@gmail.com',
            'tel' => '+1 00 00 00 00',
        ]);
    }

    public function getAdminEmail() : ?string {
        return $this->admin_email;
    }

}
