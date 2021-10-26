<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $array = [
            'test1' => 'テストデータ1',
            'test2' => 'テストデータ2',
        ];

        return $array;
    }
}
