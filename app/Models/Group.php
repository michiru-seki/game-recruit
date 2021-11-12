<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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
        'capacity',
        'recruitment',
        'description',
        'group_chat_id',
        'style_id',
        'game_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'leader_id', 'id');
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
