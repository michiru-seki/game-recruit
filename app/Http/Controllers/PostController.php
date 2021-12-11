<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function getPost(Request $request)
    {
        try {
            Log::info('グループに紐づく投稿データ取得開始');
            $post = Post::where('group_id', $request->id)->first();
            Log::info('グループに紐づく投稿データ取得終了');

            return response(["results" => $post], 200);
        } catch (\Exception $e) {
            $message = 'グループに紐づく投稿データを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function getPostDetail(Request $request)
    {
        try {
            Log::info('投稿データ取得開始');
            $userId = $request->user_id;
            $post = Post::with([
                'groupDetail.groupMember.user:id,icon,user_name',
                'groupDetail.mstStyle',
                'groupDetail.mstGame',
                'favorite'
            ])
            ->where('status_flag', 0)
            ->orderBy('updated_at', 'desc')->get();

            Log::info('投稿データ取得終了');

            return response(["results" => $post], 200);
        } catch (\Exception $e) {
            $message = '投稿データを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function upsertPost(Request $request)
    {
        try {
            Log::info('投稿テーブルにGroup情報追加処理開始');
            $post = Post::updateOrCreate(['group_id' => $request->groupId], [
                'group_id' => $request->groupId,
                'status_flag' => $request->statusFlag,
            ]);
            Log::info('投稿テーブルにGroup情報追加処理終了');

            return response(["results" => $post], 200);
        } catch (\Exception $e) {
            $message = '投稿テーブルにGroup情報追加処理を正常に完了できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
