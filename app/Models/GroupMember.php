<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class GroupMember extends Model
{
    use HasFactory;

    protected $table = 'group_member';

    protected $fillable = [
        'group_id',
        'user_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
