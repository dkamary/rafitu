<?php

namespace App\Models\Managers;

use App\Models\ContactMessage;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
            ->where('client_id', '=', $userId)
            ->count();

        return $notRead;
    }

    public static function myMessages(int $userId) : array {
        $messages = [];

        $tokens = DB::table('message')
            ->selectRaw('DISTINCT token')
            ->where('client_id', '=', $userId)
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

    public static function createToken(int $user, int $client) : string {
        $token = sprintf('%d_%d_%s', $user, $client, date('Y-m-d\TH_i_s'));

        return $token;
    }

    public static function createChat(?int $userId, ?int $clientId, ?int $sender, string $message) : Message {
        $token = self::createToken($userId, $clientId);

        Session::put('message_token', $token);
        Session::save();

        $message = Message::create([
            'token' => $token,
            'user_id' => $userId != 0 ? $userId : null,
            'client_id' => $clientId != 0 ? $clientId : null,
            'sender' => $sender,
            'date_sent' => date('Y-m-d H:i:s'),
            'content' => $message,
            'is_seen' => 0,
            'is_new' => 1,
        ]);

        return $message;
    }

    public static function sendChat(string $token, ?int $userId, ?int $clientId, ?int $sender, string $message) : Message {

        return Message::create([
            'token' => $token,
            'user_id' => $userId != 0 ? $userId : null,
            'client_id' => $clientId != 0 ? $clientId : null,
            'sender' => $sender,
            'date_sent' => date('Y-m-d H:i:s'),
            'content' => $message,
            'is_seen' => 0,
            'is_new' => 1,
        ]);
    }

    public static function lastMessageByToken(string $token) : Message {
        $message =  Message::where('token', 'like', $token)->orderBy('date_sent', 'desc')->first();

        if(!$message) return new Message();

        return $message;
    }
}
