<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function getFriends(Request $request)
    {
        try {
            Log::info('ユーザーに紐づく友だち取得開始');
            $friends = Friend::with('user')->where('user_id', $request->id)->get();
            $sortFriends = $friends->sortBy('user["user_name"]')->values()->all();
            Log::info('ユーザーに紐づく友だち取得終了');

            return response(["results" => $sortFriends], 200);
        } catch (\Exception $e) {
            $message = 'user_id:' .  $request->id . 'に紐づく友達を取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function getGroups(Request $request)
    {
        try {
            Log::info('ユーザーに紐づくグループ取得開始');
            $friends = GroupMember::with('group')->where('user_id', $request->id)->get();
            $sortGroups = $friends->sortBy('user["group_name"]')->values()->all();
            Log::info('ユーザーに紐づくグループ取得終了');

            return response(["results" => $sortGroups], 200);
        } catch (\Exception $e) {
            $message = 'user_id:' .  $request->id . 'に紐づくグループを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
