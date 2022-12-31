<?php

namespace App\Http\Controllers;

use App\Models\Managers\MessengerManager;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
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

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => $message ? $message->toArray() : [],

        ]);
    }

    public function lastMessage() : JsonResponse {
        $token = request()->input('token');
        $message =  Message::where('token', 'like', $token)
            ->where('is_new', '=', 1)
            ->orderBy('date_sent', 'desc')->first();
        if($message) {
            $message->is_new = 0;
            $message->save();
        }

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => $message ? $message->toArray() : [],
        ]);
    }

    public function conversation() : JsonResponse {
        $token = request()->input('token');
        $results = Message::where('token', 'like', $token)
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
}
