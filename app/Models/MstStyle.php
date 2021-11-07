<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstStyle extends Model
{
    use HasFactory;

    protected $table = 'mst_style';

    protected $fillable = [
        'style_name',
    ];
}
