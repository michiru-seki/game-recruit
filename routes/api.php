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
Route::get('/game/names', [App\Http\Controllers\GameNameController::class, 'getGameNames']);
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'getPost']);
Route::get('/post/detail/all', [App\Http\Controllers\PostController::class, 'getPostDetail']);
Route::get('/messages/private/{room_id}', [App\Http\Controllers\MessageController::class, 'getPrivateMessages']);
Route::get('/messages/group/{group_id}', [App\Http\Controllers\MessageController::class, 'getGroupMessages']);

Route::post('/group/edit', [App\Http\Controllers\GroupController::class, 'editGroup']);
Route::post('/group/create', [App\Http\Controllers\GroupController::class, 'createGroup']);
Route::post('/post/upsert', [App\Http\Controllers\PostController::class, 'upsertPost']);
Route::post('/private/chat/insert', [App\Http\Controllers\MessageController::class, 'createPrivateMessage']);
Route::post('/group/chat/insert', [App\Http\Controllers\MessageController::class, 'createGroupMessage']);
Route::post('/read/upsert', [App\Http\Controllers\ReadController::class, 'upsertRead']);
Route::post('/read/group/upsert', [App\Http\Controllers\ReadController::class, 'upsertReadGroup']);
