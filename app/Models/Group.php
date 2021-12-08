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
        'group_name' => 'required',
        'leader_id' => 'required',
        'icon' => 'required',
        'recruitment' => 'required',
        'style_id' => 'required|numeric',
        'game_id' => 'required|numeric',
    ];

    public static $messages = [
        'group_name.required' => 'グループ名は必須です',
        'leader_id.required' => 'leader_idは必須です',
        'icon.required' => 'アイコンは必須です',
        'recruitment.required' => '募集人数は必須です',
        'style_id.required' => 'チームスタイルは必須です',
        'game_id.required' => 'ゲーム名は必須です',
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
