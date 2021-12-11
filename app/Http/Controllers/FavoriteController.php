<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    public function getFavorite(Request $request)
    {
        try {
            Log::info('お気に入り投稿取得開始');
            $post = Favorite::with([
                'post.groupDetail', 
                'post.groupDetail.groupMember.user:id,icon,user_name', 
                'post.groupDetail.mstStyle', 
                'post.groupDetail.mstGame'
            ])
            ->where('user_id', $request->user_id)
            ->where('status_flag', 0)
            ->orderBy('updated_at', 'desc')
            ->get();
            Log::info('お気に入り投稿取得終了');

            return response(["results" => $post], 200);
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

    public function upsertFavorite(Request $request)
    {
        try {
            Log::info('お気に入り更新処理開始');
            $post = Favorite::updateOrCreate(['user_id' => $request->user_id, 'post_id' => $request->post_id], [
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'status_flag' => $request->status_flag,
            ]);
            Log::info('お気に入り更新処理終了');

            return response(["results" => $post], 200);
        } catch (\Exception $e) {
            $message = 'お気に入り更新処理を正常に完了できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
