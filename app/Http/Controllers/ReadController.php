<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Read;
use App\Models\PrivateChat;
use App\Models\GroupChat;
use App\Models\ReadedGroupChat;
use Illuminate\Support\Facades\Log;
use App\Events\ReadPrivateCreated;
use App\Events\ReadGroupCreated;

class ReadController extends Controller
{
    public function upsertRead(Request $request)
    {
        try {
            Log::info('プライベートチャット既読処理開始');
            // 条件用の配列
            $readCondition = [];
            // 登録用の配列
            $readData = [];

            // updateOrCreateの第一引数で使用する条件用の配列と登録用の配列を作成
            $readCondition['user_id'] = $request->user_id;
            $readData['user_id'] = $request->user_id;
            $readCondition['friend_user_id'] = $request->friend_user_id;
            $readData['friend_user_id'] = $request->friend_user_id;
            // 登録用の配列にwatch_dateの値を設定
            $readData['watch_date'] = $request->watch_date;
            
            $read = Read::updateOrCreate($readCondition, $readData);
            $messages = PrivateChat::with('groupChat')->where('private_room_id', $request->room_id)
            ->where('user_id', $request->friend_user_id)
            ->where('read_status', 0)
            ->get();

            if(count($messages) > 0) {
                foreach($messages as $message) {
                    $message['read_status'] = 1;
                    $message->save();
                }
                event(new ReadPrivateCreated($messages));
            }
            Log::info('プライベートチャット既読処理終了');

            return response(["results" => $read], 200);
        } catch (\Exception $e) {
            $message = 'プライベートチャット既読処理を正常に完了できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function upsertReadGroup(Request $request)
    {
        try {
            Log::info('グループチャット既読処理開始');
            // 条件用の配列
            $readCondition = [];
            // 登録用の配列
            $readData = [];
            $newReadedGroupChat = [];

            // updateOrCreateの第一引数で使用する条件用の配列と登録用の配列を作成
            $readCondition['user_id'] = $request->user_id;
            $readData['user_id'] = $request->user_id;
            $readCondition['group_id'] = $request->group_id;
            $readData['group_id'] = $request->group_id;
            // 登録用の配列にwatch_dateの値を設定
            $readData['watch_date'] = $request->watch_date;
            
            $read = Read::updateOrCreate($readCondition, $readData);
            $messages = GroupChat::where('group_id', $request->group_id)
            ->where('user_id', '<>', $request->user_id)
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();
            Log::debug($messages);

            foreach($messages as $message) {
                $message['read_status'] = 1;
                $message->save();
                $readedGroupChat = ReadedGroupChat::where('group_chat_id', $message->id)
                ->where('read_user_id', $request->user_id)
                ->first();
                Log::debug($readedGroupChat);

                if(!$readedGroupChat) {
                    $newReadedGroupChat[] = ReadedGroupChat::create([
                        'group_chat_id' => $message->id,
                        'read_user_id' => $request->user_id,
                    ]);
                }
            }
            if(count($newReadedGroupChat) > 0) {
                event(new ReadGroupCreated($newReadedGroupChat));
            }
            Log::info('グループチャット既読処理終了');

            return response(["results" => $newReadedGroupChat], 200);
        } catch (\Exception $e) {
            $message = 'グループチャット既読処理を正常に完了できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
