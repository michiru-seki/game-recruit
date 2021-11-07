<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
