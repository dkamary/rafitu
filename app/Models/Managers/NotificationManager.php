<?php

namespace App\Models\Managers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationManager {
    public static function sendEmail(string $to, string $subject, string $content) {
        try {
            $headers = "MIME-Version: 1.0 \r\n";
            $headers .= "Content-type:text/html;charset=UTF-8 \r\n";
            $headers .= 'From: '. config('rafitu.sender') ." \r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion() ."\r\n";

            mail($to, $subject, $content, $headers);
        } catch(Throwable $th) {
            Log::warning(sprintf('Une erreur est survenue lors l\'envoie de mail: %s', $th->getMessage()));
            throw $th;
        }
    }

    public static function getNotification(User $user) : Collection {
        /**
         * @var Builder $builder
         */
        $builder = Notification::where('is_active', '=', 1);
        $builder
            ->where(function(Builder $qb) use($user) {
                $qb->where('user_id', '=', (int)$user->id);
                if($user->isAdmin()) {
                    $qb->orWhereNull('user_id');
                }
            })
            ->orderBy('created_at', 'desc');

        $notifications = $builder->get();

        return $notifications;
    }

    public static function createNotification(string $notificationType, ?int $userId, string $title, ?string $content = null, ?string $link = null ) : ?Notification {
        try {

            return Notification::create([
                'user_id' => $userId,
                'title' => $title,
                'content' => $content,
                'link' => $link,
                'notification_type' => $notificationType,
                'is_read' => 0,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ]);
        } catch (\Throwable $th) {
            $message = sprintf('Une erreur est survenue lors de la création de la notification: %s', $th->getMessage());
            Log::warning($message, [
                'exception' => $th->getCode(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);
        }

        return null;
    }

    public static function createNotificationInfo(?int $userId, string $title, ?string $content = null, ?string $link = null) : ?Notification {
        return self::createNotification(Notification::TYPE_INFO, $userId, $title, $content, $link);
    }

    public static function createNotificationSuccess(?int $userId, string $title, ?string $content = null, ?string $link = null) : ?Notification {
        return self::createNotification(Notification::TYPE_SUCCESS, $userId, $title, $content, $link);
    }

    public static function createNotificationWarning(?int $userId, string $title, ?string $content = null, ?string $link = null) : ?Notification {
        return self::createNotification(Notification::TYPE_WARNING, $userId, $title, $content, $link);
    }

    public static function createNotificationError(?int $userId, string $title, ?string $content = null, ?string $link = null) : ?Notification {
        return self::createNotification(Notification::TYPE_ERROR, $userId, $title, $content, $link);
    }

}
