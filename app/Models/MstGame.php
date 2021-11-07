<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstGame extends Model
{
    use HasFactory;

    protected $table = 'mst_game';

    protected $fillable = [
        'game_name',
    ];
}
