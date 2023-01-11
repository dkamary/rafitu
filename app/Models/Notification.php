<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';

    protected $table = 'notification';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'title', 'content', 'link', 'notification_type', 'is_read', 'is_active', 'created_at', 'updated_at',];
    // public $timestamps = false;

    protected $user;

    public function getUser() : ?User {
        return $this->user ?: $this->user = User::where('id', '=', (int)$this->user_id)->first();
    }

    public function isActive() : bool {
        return $this->is_active == 1;
    }

    public function isRead() : bool {
        return $this->is_read;
    }

    public function isSuccess() : bool {
        return $this->notification_type == self::TYPE_SUCCESS;
    }

    public function isInfo() : bool {
        return $this->notification_type == self::TYPE_INFO;
    }

    public function isWarning() : bool {
        return $this->notification_type == self::TYPE_WARNING;
    }

    public function isError() : bool {
        return $this->notification_type == self::TYPE_ERROR;
    }

    public function isForAdmin() : bool {
        return is_null($this->user_id);
    }

    public function getDate(bool $formated = false) {
        $date = new DateTime($this->created_at);
        if(!$formated) return $date;

        $now = new DateTime();
        $diff = $now->diff($date);
        if($diff->d < 1) {
            return 'Aujourd\'hui à ' . $date->format('H:i:s');
        } elseif($diff->d == 1) {
            return 'Hier à ' . $date->format('H:i:s');
        } elseif($diff->d == 2) {
            return 'Avant hier à ' . $date->format('H:i:s');
        } else {
            return $date->format('d/m/Y à H:i:s');
        }
    }
}
