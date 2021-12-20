<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use App\Models\PostSubscription;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        try {
            Log::info('通知情報取得開始');
            $notifications = Notification::where(['user_id' => $request->user_id, 'read_status' => 0])->get();
            Log::info('通知情報取得終了');

            return response(["results" => $notifications], 200);
        } catch (\Exception $e) {
            $message = '通知情報を取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function sendReply(Request $request)
    {
        try {
            Log::info('応募リクエストの返答処理開始');
            $reply = null;

            if($request->reply === 'permission') {
                // 応募リクエストへの返答が許可だった際
                $reply = 0;
            } elseif($request->reply === 'rejection') {
                // 応募リクエストへの返答が拒否だった際
                $reply = 1;
            }
            
            // 通知を未読から既読に変更
            $notification = Notification::with('postSubscription')->where(['id' => $request->notifications_id])->first();
            if($notification) {
                $notification->read_status = 1;
                $notification->save();
            }

            // 投稿募集のステータスを変更
            $postSubscription = PostSubscription::with('post.groupDetail:id')->find($notification->postSubscription->id);
            $postSubscription->status_flag = $reply;
            $postSubscription->save();

            if($reply === 0) {
                // グループのメンバーへ追加
                $groupMember = GroupMember::where(['group_id' => $postSubscription->post->groupDetail->id, 'user_id' => $postSubscription->user_id])->first();
                if(!$groupMember) {
                    GroupMember::create([
                        'group_id' => $postSubscription->post->groupDetail->id,
                        'user_id' => $postSubscription->user_id
                    ]);

                    // グループの参加人数更新
                    $groupMemberCount = GroupMember::where('group_id', $postSubscription->post->groupDetail->id)->count();
                    $group = Group::find($postSubscription->post->groupDetail->id);
                    $group->participants = $groupMemberCount;
                    $group->save();
                }
            }

            Log::info('応募リクエストの返答処理終了');

            return response(["results" => $postSubscription], 200);
        } catch (\Exception $e) {
            $message = '応募リクエストの返答処理を完了できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
