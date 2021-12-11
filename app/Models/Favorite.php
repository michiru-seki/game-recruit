<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';

    protected $fillable = [
        'user_id',
        'post_id',
        'status_flag',
    ];

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
}
