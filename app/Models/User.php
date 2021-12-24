<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Friend;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'user_name',
        'password',
        'icon',
        'game',
        'introduction',
    ];

    public static $rules = array(
        'user_name' => 'required|unique:users|max:256',
        'password' => 'required|min:6',
        'icon' => 'file|mimes:jpg,png,webp,svg',
        'game' => 'max:5000',
        'introduction' => 'max:5000',
    );

    public static $messages = array(
        'user_name.required' => '＊ユーザーネームは必須です',
        'user_name.unique' => '＊そのユーザーネームは既に使用されています',
        'password.required' => '＊パスワードは必須です',
        'password.min' => '＊パスワードは6文字以上で設定してください',
    );
}
