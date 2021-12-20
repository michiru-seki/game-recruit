<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostSubscription;
use App\Models\Notification;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use App\Constants\Message;

class SubscriptionController extends Controller
{
    public function getSubscription(Request $request)
    {
        try {
            $usesrId = $request->user_id;
            $postId = $request->post_id;
            Log::info('応募情報取得開始');
            $subscription = PostSubscription::where(['user_id' => $usesrId, 'post_id' => $postId])->first();
            Log::info('応募情報取得終了');

            return response(["results" => $subscription], 200);
        } catch (\Exception $e) {
            $message = '応募情報を取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function joinRequest(Request $request)
    {
        try {
            $userId = $request->user_id;
            $postId = $request->post_id;
            $leaderId = $request->leader_id;

            $requestUser = User::select('user_name')->where('id', $userId)->first();
            $post = Post::with('groupDetail')->where('id', $postId)->first();
            $notificationMessage = $requestUser->user_name . Message::GROUP_JOIN_REQUEST($post->groupDetail->group_name);

            Log::info('応募情報登録開始');
            $subscription = PostSubscription::updateOrCreate(['user_id' => $userId, 'post_id' => $postId], [
                'user_id' => $userId,
                'post_id' => $postId,
                'status_flag' => 2,
            ]);

            Notification::create([
                'user_id' => $leaderId,
                'request_user_id' => $userId,
                'post_subscription_id' => $subscription->id,
                'read_status' => 0,
                'message' => $notificationMessage,
            ]);
            Log::info('応募情報登録終了');

            return response(["results" => $subscription], 200);
        } catch (\Exception $e) {
            $message = '応募情報を登録できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
