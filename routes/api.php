<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', [App\Http\Controllers\LoginController::class, 'register']);
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/friends/{id}', [App\Http\Controllers\FriendController::class, 'getFriends']);
Route::get('/groups/userid/{id}', [App\Http\Controllers\GroupController::class, 'getGroupsUseUserId']);
Route::get('/groups/groupid/{id}', [App\Http\Controllers\GroupController::class, 'getGroupsUseGroupId']);
Route::get('/group/member/{id}', [App\Http\Controllers\GroupController::class, 'getGroupMember']);
Route::get('/game/styles', [App\Http\Controllers\GameStyleController::class, 'getGameStyles']);
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'getPost']);

Route::post('/group/edit', [App\Http\Controllers\GroupController::class, 'editGroup']);
Route::post('/post/upsert', [App\Http\Controllers\PostController::class, 'upsertPost']);
