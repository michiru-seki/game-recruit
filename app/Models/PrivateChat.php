<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PrivateChat extends Model
{
    use HasFactory;

    protected $table = 'private_chat';

    protected $fillable = [
        'private_room_id',
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
}
