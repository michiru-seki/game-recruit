<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\GroupMember;
use App\Models\MstStyle;
use App\Models\MstGame;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'group_name',
        'leader_id',
        'icon',
        'participants',
        'recruitment',
        'description',
        'style_id',
        'game_id',
    ];

    public static $rules = [
        'group_name' => 'required|max:256',
        'leader_id' => 'required',
        'icon' => 'file|mimes:jpg,png,webp,svg',
        'recruitment' => 'required|numeric',
        'style_id' => 'required|numeric',
        'game_id' => 'required|numeric',
        'description' => 'required|max:5000',
    ];

    public static $messages = [
        'group_name.required' => '＊グループ名は必須です',
        'group_name.max' => '＊グループ名は256文字以内で設定してください',
        'leader_id.required' => 'leader_idは必須です',
        'icon.file' => 'アイコンはファイルを選択してください',
        'icon.mimes' => 'アイコンは画像ファイルを選択してください',
        'recruitment.required' => '＊募集人数は必須です',
        'recruitment.numeric' => '＊募集人数は数字を指定してください',
        'style_id.required' => '＊スタイルは必須です',
        'style_id.numeric' => '＊スタイルは選択肢から選んでください',
        'game_id.required' => 'ゲーム名は必須です',
        'game_id.numeric' => '＊スタイルは選択肢から選んでください',
        'description.required' => '＊ゲーム名は必須です',
        'description.max' => '＊詳細は5000文字以内で設定してください',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'leader_id', 'id');
    }

    public function groupMember()
    {
        return $this->hasMany(GroupMember::class, 'group_id', 'id');
    }

    public function mstStyle()
    {
        return $this->belongsTo(MstStyle::class, 'style_id', 'id');
    }

    public function mstGame()
    {
        return $this->belongsTo(MstGame::class, 'game_id', 'id');
    }
}
