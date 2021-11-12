<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstStyle;
use Illuminate\Support\Facades\Log;

class GameStyleController extends Controller
{
    public function getGameStyles()
    {
        try {
            Log::info('ゲームスタイル取得開始');
            $gameStyles = MstStyle::get();
            Log::info('ゲームスタイル取得終了');

            return response(["results" => $gameStyles], 200);
        } catch (\Exception $e) {
            $message = 'ゲームスタイルを取得できませんでした';
            Log::error($e);
            Log::error($message);
            return response([
                "error" => $e,
                "message" => $message,
            ], 500);
        }
    }
}
