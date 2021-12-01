<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\PrivateChat;
use App\Models\GroupChat;
use Illuminate\Support\Facades\Log;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function getPrivateMessages(Request $request)
    {
        try {
            Log::info('友だちとのメッセージ取得開始');
            // $privateRoom = Friend::where('user_id', $request->user_id)->where('friend_user_id', $request->friend_id)->first();
            $messages = PrivateChat::with('user')->where('private_room_id', $request->room_id)->get();
            Log::info('友だちとのメッセージ取得終了');

            return response(["results" => [ 'messages' => $messages ]], 200);
        } catch (\Exception $e) {
            $message = '友だちとのメッセージを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function getGroupMessages(Request $request)
    {
        try {
            Log::info('グループのメッセージ取得開始');
            $messages = GroupChat::with(['user', 'readedGroupChat'])
            ->where('group_id', $request->group_id)->get();
            Log::info('グループのメッセージ取得終了');

            return response(["results" => [ 'messages' => $messages ]], 200);
        } catch (\Exception $e) {
            $message = 'グループのメッセージを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function createPrivateMessage(Request $request)
    {
        try {
            Log::info('プライベートチャット登録開始');
            $message = PrivateChat::create([
                'private_room_id' => $request->private_room_id,
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);
            event(new MessageCreated($message));
            Log::info('プライベートチャット登録終了');

            return response(["results" => $message], 200);
        } catch (\Exception $e) {
            $message = 'プライベートチャットに登録できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function createGroupMessage(Request $request)
    {
        try {
            Log::info('グループチャット登録開始');
            $message = GroupChat::create([
                'group_id' => $request->group_id,
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);
            event(new MessageCreated($message));
            Log::info('グループチャット登録終了');

            return response(["results" => $message], 200);
        } catch (\Exception $e) {
            $message = 'グループチャットに登録できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
