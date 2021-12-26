<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller
{
    public function getUserDetail(Request $request)
    {
        try {
            $usesrId = $request->user_id;
            Log::info('お気に入り投稿取得開始');
            $user = User::where('id', $usesrId)->first();
            Log::info('お気に入り投稿取得終了');

            return response(["results" => $user], 200);
        } catch (\Exception $e) {
            $message = 'お気に入り投稿を取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function updateUserDetail(Request $request)
    {
        try {
            $userId = $request->id;
            Log::info('ユーザー情報更新開始');
            // リクエストから画像ファイルを取得
            $image = $request->file('icon');

            $user = User::where('id', $userId)->first();

            if($image) {
                // バケットのimagesフォルダへアップロード
                $path = Storage::disk('s3')->put('icon', $image, 'public');
                $url = Storage::disk('s3')->url($path);
            } else {
                if($user->icon === $request->icon) {
                    $url = $user->icon;
                } else {
                    $url = null;
                }
            }

            $user->user_name = $request->user_name;
            $user->icon = $url;
            $user->game = $request->game === 'null' ? null : $request->game;
            $user->introduction = $request->introduction === 'null' ? null : $request->introduction;
            $user->save();
            Log::info('ユーザー情報更新終了');

            return response(["results" => $user], 200);
        } catch (\Exception $e) {
            $message = 'ユーザー情報の更新できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
