<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    use HasFactory;

    protected $table = 'reads';

    protected $fillable = [
        'user_id',
        'friend_user_id',
        'group_id',
        'watch_date',
    ];
}
