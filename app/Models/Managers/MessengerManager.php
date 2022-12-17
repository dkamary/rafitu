<?php

namespace App\Models\Managers;

use App\Models\ContactMessage;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class MessengerManager
{
    public static function preview(int $count = 10): stdClass
    {
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

    public static function myMessagesCount(int $userId): int
    {
        $notRead = Message::where('is_seen', '=', 0)
            ->where('receiver_id', '=', $userId)
            ->count();

        return $notRead;
    }

    public static function myMessages(int $userId) : array {
        $messages = [];
        // $messagesByToken = Message::where('sender_id', '=', $userId)
        //     ->orWhere('receiver_id', '=', $userId)
        //     ->orderBy('date_sent', 'DESC')
        //     ->groupBY('token')
        //     ->limit(10)
        //     ->get();

        $tokens = DB::table('message')
            ->selectRaw('DISTINCT token')
            ->where('receiver_id', '=', $userId)
            ->limit(10)
            ->get();

        foreach($tokens as $msgToken) {
            $messages[$msgToken->token] = self::myMessagesByToken($msgToken->token);
        }

        return $messages;
    }

    public static function myMessagesByToken(string $token, int $count = 20) : ?Collection {
        return Message::where('token', 'LIKE', $token)
            ->orderBy('date_sent', 'DESC')
            ->limit($count)
            ->get();
    }
}
