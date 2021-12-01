<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\MstGame;
use App\Models\MstStyle;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'group_id',
        'status_flag',
    ];

    public function groupDetail()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function groupGame()
    {
        // return $this->belongsToMany(MstGame::class)->using(Group::class);
        return $this->hasOneThrough(
            MstGame::class,
            Group::class,
            'game_id', // groupsの外部キー
            'id', // mst_gameの外部キー
            'id',
            'game_id',
        );
    }
    
    public function groupStyle()
    {
        // return $this->belongsToMany(MstStyle::class)->using(Group::class);
        return $this->hasOneThrough(
            MstStyle::class,
            Group::class,
            'style_id', // groupsの外部キー
            'id', // mst_styleの外部キー
            'id',
            'style_id',
        );
    }
}
