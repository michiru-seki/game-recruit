<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PrivateChat;

class Friend extends Model
{
    use HasFactory;

    protected $table = 'friends';

    protected $fillable = [
        'user_id',
        'friend_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'friend_user_id', 'id');
    }

    public function privateChat()
    {
        return $this->hasMany(PrivateChat::class, 'private_room_id', 'id');
    }
}
