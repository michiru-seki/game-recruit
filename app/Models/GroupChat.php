<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReadedGroupChat;
use App\Models\User;

class GroupChat extends Model
{
    use HasFactory;

    protected $table = 'group_chat';

    protected $fillable = [
        'group_id',
        'user_id',
        'message',
        'image',
        'movie',
        'read_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function readedGroupChat()
    {
        return $this->hasMany(ReadedGroupChat::class, 'group_chat_id', 'id');
    }
}
