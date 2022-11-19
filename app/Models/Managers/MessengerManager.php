<?php

namespace App\Models\Managers;

use App\Models\ContactMessage;
use stdClass;

class MessengerManager {
    public static function preview(int $count = 10) : stdClass {
        $notRead = ContactMessage::where('is_read', '=', 0)->count();
        $messages = ContactMessage::where('is_read', '=>', 0)
            ->orderBy('sent_date', 'desc')
            ->limit($count)
            ->get();

        $preview = [
            'notRead' => $notRead,
            'messages' => $messages,
        ];

        return (object)$preview;
    }
}
