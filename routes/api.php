<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/friends/{id}', [App\Http\Controllers\HomeController::class, 'getFriends']);
Route::get('/groups/{id}', [App\Http\Controllers\HomeController::class, 'getGroups']);
