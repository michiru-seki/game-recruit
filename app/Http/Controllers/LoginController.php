<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        // バリデーション
        $this->validate($request, User::$rules, User::$messages);

        try {
            Log::info('ユーザー登録処理開始');
            
            $user = User::create([
                'user_name' => $request->user_name,
                'password' => Hash::make($request->password),
            ]);
    
            Log::info('ユーザー登録処理終了');

            return response(["results" => $user], 200);
        } catch (\Exception $e) {
            $message = 'ユーザーの登録ができませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

    public function login(Request $request)
    {
        // バリデーション
        $rules = array(
            'user_name' => 'required',
            'password' => 'required',
        );
    
        $messages = array(
            'user_name.required' => '＊ユーザー名を入力してください',
            'password.required' => '＊パスワードが入力してください',
        );

        $this->validate($request, $rules, $messages);

        try {
            Log::info('ログイン処理開始');
            $userName = $request->user_name;
            $userPassword = $request->password;

            Log::info($userName);
            Log::info($userPassword);
            
            if(!(Auth::attempt($request->only('user_name', 'password')))){
                $message = '＊ユーザー名またはパスワードが違います';
                Log::error($message);
                return response([
                    "message" => $message,
                ], 422);
            };      
    
            Log::info('ログイン処理終了');

            return response(["results" => Auth::user()]);
        } catch (\Exception $e) {
            $message = 'ログインが正常に完了できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }

}
