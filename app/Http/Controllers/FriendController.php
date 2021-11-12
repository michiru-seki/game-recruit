<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use Illuminate\Support\Facades\Log;

class FriendController extends Controller
{
    public function getFriends(Request $request)
    {
        try {
            Log::info('ユーザーに紐づく友だち取得開始');
            $friends = Friend::with('user:id,user_name,icon')->where('user_id', $request->id)->get();
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
}
