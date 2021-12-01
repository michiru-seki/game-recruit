<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupChat;

class ReadedGroupChat extends Model
{
    use HasFactory;

    protected $table = 'readed_group_chat';

    protected $fillable = [
        'group_chat_id',
        'read_user_id',
    ];

    public function groupChat()
    {
        $this->belongsTo(GroupChat::class, 'group_chat_id', 'id');
    }
}
