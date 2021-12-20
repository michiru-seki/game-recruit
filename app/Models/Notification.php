<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostSubscription;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'request_user_id',
        'post_subscription_id',
        'read_status',
        'message',
    ];

    public function postSubscription()
    {
        return $this->belongsTo(PostSubscription::class, 'post_subscription_id', 'id');
    }
}
