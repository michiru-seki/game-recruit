<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    public function getGroupsUseUserId(Request $request)
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

    public function getGroupsUseGroupId(Request $request)
    {
        try {
            Log::info('ユーザーに紐づくグループ取得開始');
            $groupId = $request->id;
            $group = Group::with(['user:id,user_name,icon', 'mstStyle:id,style_name', 'mstGame:id,game_name'])->where('id', $groupId)->first();
            Log::info('ユーザーに紐づくグループ取得終了');

            return response(["results" => $group], 200);
        } catch (\Exception $e) {
            $message = 'id:' .  $request->id . 'に紐づくグループを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function getGroupMember(Request $request)
    {
        try {
            Log::info('グループのメンバー取得開始');
            $groupId = $request->id;
            $groupMember = GroupMember::select('user_id')->with('user:id,user_name,icon')->where('group_id', $groupId)->get();
            Log::info('グループのメンバー取得終了');

            return response(["results" => $groupMember], 200);
        } catch (\Exception $e) {
            $message = 'グループのメンバーを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function editGroup(Request $request)
    {
        try {
            Log::info('グループ情報編集開始');
            $group = Group::find($request->id);
            $group->group_name = $request->group_name;
            $group->style_id = $request->style_id;
            $group->recruitment = $request->recruitment;
            $group->description = $request->description;
            $group->save();
            Log::info('グループ情報編集終了');

            return response(["results" => $group], 200);
        } catch (\Exception $e) {
            $message = 'グループ情報を編集できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
