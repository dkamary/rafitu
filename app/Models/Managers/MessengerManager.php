<?php

namespace App\Models\Managers;

use App\Models\ContactMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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
        $notRead = DB::table('message')
            ->selectRaw('DISTINCT `token`')
            ->whereRaw('`is_seen` = 0')
            ->whereRaw('(`user_id` = ? OR `client_id` = ? OR `sender` = ?)', [$userId, $userId, $userId])
            ->count();

        return $notRead;
    }

    public static function myMessagesPreview(int $userId, int $isDeleted = 0) : array {
        $messages = [];

        $builder = DB::table('message')
            ->selectRaw('DISTINCT token, date_sent')
            ->where('is_deleted', '=', $isDeleted)
            ->whereRaw('(`user_id` = ? OR `client_id` = ? OR `sender` = ?)', [$userId, $userId, $userId], 'or');

        /**
         * @var User $user
         */
        $user = auth()->user();
        if($user && $user->isAdmin()) {
            $builder->whereRaw('(user_id IS NULL OR user_id = ?)', [$userId], 'or');
        }

        $tokens = $builder
            // ->limit(10)
            ->orderBy('date_sent', 'DESC')
            ->get();

        foreach($tokens as $msgToken) {
            $lastMsg = self::lastMessageByToken($msgToken->token);
            if(strlen($lastMsg->token) > 3) $messages[$msgToken->token] = $lastMsg;
        }

        // !TODO: Order by PHP
        usort($messages, function(Message $a, Message $b){
            $dateA = new \DateTime($a->date_sent);
            $dateB = new \DateTime($b->date_sent);

            return $dateB->getTimestamp() - $dateA->getTimestamp();
        });

        return $messages;
    }

    public static function myAdminMessagesPreview(int $userId, int $isDeleted = 0) : array {
        $messages = [];

        $tokens = DB::table('message')
            ->selectRaw('DISTINCT token')
            ->whereRaw('(user_id IS NULL OR user_id = ?)', [$userId])
            ->where('is_deleted', '=', $isDeleted)
            ->limit(10)
            ->get();

        foreach($tokens as $msgToken) {

            $messages[$msgToken->token] = self::lastMessageByToken($msgToken->token);
        }

        return $messages;
    }

    public static function myMessages(int $userId, int $isDeleted = 0) : array {
        $messages = [];

        $tokens = DB::table('message')
            ->selectRaw('DISTINCT token')
            ->where('client_id', '=', $userId)
            ->where('is_deleted', '=', $isDeleted)
            ->limit(10)
            ->get();

        foreach($tokens as $msgToken) {
            $messages[$msgToken->token] = self::myMessagesByToken($msgToken->token);
        }

        return $messages;
    }

    public static function myMessagesByToken(string $token, int $isDeleted = 0, int $count = 20) : ?Collection {
        return Message::where('token', 'LIKE', $token)
            ->where('is_deleted', '=', $isDeleted)
            ->orderBy('date_sent', 'ASC')
            // ->limit($count)
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
        $message =  Message::where('token', 'like', $token)
            ->where('is_deleted', '=', 0)
            ->orderBy('date_sent', 'desc')
            ->first();

        if(!$message) return new Message();

        return $message;
    }

    public static function getUserName(?int $userId, string $default = 'n/a') : string {
        if(!$userId) return $default;

        $user = User::where('id', '=', $userId)->first();
        if(!$user) return $default;

        return $user->firstname;
    }

    /**
     * Information de la conversation
     *
     * @param string $token
     * @param User|null $currentUser
     * @return array
     */
    public static function getConversationInfo(string $token, ?User $currentUser = null) : array {
        /**
         * @var User $user
         */
        $user = $currentUser ?: Auth::user();
        $conversation = DB::table('message')
            ->select(['user_id', 'client_id'])
            ->where('token', 'like', $token)
            // ->whereRaw('(`user_id` = ? OR `client_id` = ?)', [$user->id, $user->id])
            ->groupBy('user_id', 'client_id')
            ->first();

        $sender = $user;
        $receiver = null;

        if($user->id == $conversation->user_id) {
            $receiver = User::where('id', '=', $conversation->client_id)->first();
        } elseif($user->id == $conversation->client_id) {
            $receiver = User::where('id', '=', $conversation->user_id)->first();
        } else {
            $receiver = $user->isAdmin() ?
                User::where('id', '=', $conversation->client_id)->first() :
                User::where('email', 'like', NotificationAdminManager::getAdminEmail())->first();
        }

        return [
            'sender' => $sender,
            'receiver' => $receiver,
        ];
    }
}
