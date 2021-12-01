<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Psy\debug;

class LoginController extends Controller
{

    public function register(Request $request)
    {

        $user = User::create([
            'user_name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return response(["results" => $user], 200);
    }

    public function login(Request $request)
    {
        $userName = $request->name;
        $userPassword = $request->password;

        Log::debug($userPassword);
        $userData = User::Where('user_name', $userName)
            ->Where('password', $userPassword)
            ->first();
        
        if(empty($userData)){
            return response(500);
        };
        
        Log::debug($userData);


        return response(["results" => $userData]);
    }
}
