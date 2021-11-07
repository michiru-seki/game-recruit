<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSubscription extends Model
{
    use HasFactory;

    protected $table = 'post_subscriptions';

    protected $fillable = [
        'user_id',
        'post_id',
        'status_flag',
    ];
}
