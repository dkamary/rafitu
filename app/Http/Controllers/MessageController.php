<?php

namespace App\Http\Controllers;

use App\Models\IamConnected;
use App\Models\Managers\MessengerManager;
use App\Models\Managers\NotificationAdminManager;
use App\Models\Managers\UserManager;
use App\Models\Message;
use App\Models\User;
use App\Models\UserConnected;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request) : JsonResponse {
        $token = $request->input('token');
        $message = null;

        if(!$token) {
            $message = MessengerManager::createChat((int)$request->input('user_id'), (int)$request->input('client_id'), $request->input('sender'), (string)$request->input('message'));
        } else {
            $message = MessengerManager::sendChat($token, (int)$request->input('user_id'), (int)$request->input('client_id'), $request->input('sender'), (string)$request->input('message'));
        }

        if(!$message->user_id) {
            NotificationAdminManager::newMessageToAdmin($message);
        }

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => $message ? $message->toArray() : [],

        ]);
    }

    public function lastMessage() : JsonResponse {
        $token = request()->input('token');
        $message =  Message::where('token', 'like', $token)
            ->where('is_deleted', '=', 0)
            ->orderBy('date_sent', 'desc')->first();
        if($message) {
            $message->is_new = 0;
            $message->save();
        }

        UserManager::IamConnected();

        $isConnected = false;
        if($message) {
            $userId = (auth()->id() == $message->client_id) ? $message->user_id : $message->client_id;
            $isConnected = UserManager::isConnected((int)$userId);
        }

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => $message ? $message->toArray() : [],
            'isConnected' => $isConnected,
        ]);
    }

    public function conversation() : JsonResponse {
        $token = request()->input('token');
        /**
         * @var Builder $builder
         */
        $builder = Message::where('token', 'like', $token)
            ->where('is_deleted', '=', 0);
        $offset = 0;
        $count = $builder->count();
        if($count > 20) {
            $offset = $count - 20;
            $builder->offset($offset);
        }
        // dd($builder->toSql());
        $results = $builder
            ->orderBy('date_sent', 'asc')
            ->limit(20)
            ->get();
        $conversation = [];
        foreach($results as $r) {
            $conversation[] = $r->toArray();
        }

        return response()->json([
            'done' => true,
            'error' => false,
            'conversation' => $conversation,
        ]);
    }

    public function startChatWith(User $driver) : RedirectResponse {
        $user = auth()->user();

        $message = MessengerManager::createChat($driver->id, $user->id, $user->id, request()->input('content'));

        return response()->redirectToRoute('dashboard_messenger_show', [
            'token' => $message->token,
        ]);
    }


    public function seen() : JsonResponse {
        $message = Message::where('id', '=', (int)request()->input('id'))->first();
        if(!$message) {

            return response()->json([
                'done' => false,
                'error' => true,
                'message' => 'Message not found!',
            ]);
        }

        $message
            ->seen()
            ->save();

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => $message->toArray(),
        ]);
    }

    public function remove(Request $request) : JsonResponse {
        $message = Message::where('id', '=', (int)$request->input('id'))->first();
        if(!$message) {

            return response()->json([
                'done' => false,
                'error' => true,
                'message' => 'Message not found!',
            ]);
        }

        $message->is_deleted = 1;
        $message->save();

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => $message->toArray(),
        ]);
    }
}
