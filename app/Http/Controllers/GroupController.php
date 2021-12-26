<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        // バリデーション
        $rules = array(
            'group_name' => 'required|max:256',
            'recruitment' => 'required|numeric',
            'style_id' => 'required|numeric',
            'description' => 'required|max:5000',
        );
    
        $messages = array(
            'group_name.required' => '＊グループ名は必須です',
            'group_name.max' => '＊グループ名は256文字以内で設定してください',
            'recruitment.required' => '＊募集人数は必須です',
            'recruitment.numeric' => '＊募集人数は数字を指定してください',
            'style_id.required' => '＊スタイルは必須です',
            'style_id.numeric' => '＊スタイルは選択肢から選んでください',
            'description.required' => '＊ゲーム名は必須です',
            'description.max' => '＊詳細は5000文字以内で設定してください',
        );

        $this->validate($request, $rules, $messages);

        try {
            $groupId = $request->id;
            Log::info('グループ情報編集開始');
            // リクエストから画像ファイルを取得
            $image = $request->file('icon');

            $group = Group::where('id', $groupId)->first();

            if($image) {
                // バケットのimagesフォルダへアップロード
                $path = Storage::disk('s3')->put('icon', $image, 'public');
                $url = Storage::disk('s3')->url($path);
            } else {
                if($group->icon === $request->icon) {
                    $url = $group->icon;
                } else {
                    $url = null;
                }
            }

            $group = Group::find($request->id);
            $group->group_name = $request->group_name;
            $group->icon = $url;
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

    public function createGroup(Request $request)
    {
        $this->validate($request, Group::$rules, Group::$messages);
        try {
            // $request->test = 'test';
            Log::info('グループ作成開始');
            // リクエストから画像ファイルを取得
            $image = $request->file('icon');

            if($image) {
                // バケットのimagesフォルダへアップロード
                $path = Storage::disk('s3')->put('icon', $image, 'public');
                $url = Storage::disk('s3')->url($path);
            } else {
                $url = null;
            }

            $group = Group::create([
                'group_name' => $request->group_name,
                'leader_id' => $request->leader_id,
                'icon' => $url,
                'participants' => 1,
                'recruitment' => $request->recruitment,
                'description' => $request->description,
                'style_id' => $request->style_id,
                'game_id' => $request->game_id,
            ]);

            // グループメンバー作成
            GroupMember::create([
                'group_id' => $group->id,
                'user_id' => $group->leader_id,
            ]);

            Log::info('グループ作成終了');

            return response(["results" => $group], 200);
        } catch (\Exception $e) {
            $message = 'グループを作成できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
