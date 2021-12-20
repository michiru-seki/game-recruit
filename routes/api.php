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
Route::get('/post/detail/all/{user_id}', [App\Http\Controllers\PostController::class, 'getPostDetail']);
Route::get('/messages/private/{room_id}', [App\Http\Controllers\MessageController::class, 'getPrivateMessages']);
Route::get('/messages/group/{group_id}', [App\Http\Controllers\MessageController::class, 'getGroupMessages']);
Route::get('/post/favorite/{user_id}', [App\Http\Controllers\FavoriteController::class, 'getFavorite']);
Route::get('/mypage/{user_id}', [App\Http\Controllers\MypageController::class, 'getUserDetail']);
Route::get('/subscriptions/{user_id}/{post_id}', [App\Http\Controllers\SubscriptionController::class, 'getSubscription']);
Route::get('/notification/{user_id}', [App\Http\Controllers\NotificationController::class, 'getNotifications']);

Route::post('/group/edit', [App\Http\Controllers\GroupController::class, 'editGroup']);
Route::post('/group/create', [App\Http\Controllers\GroupController::class, 'createGroup']);
Route::post('/post/upsert', [App\Http\Controllers\PostController::class, 'upsertPost']);
Route::post('/private/chat/insert', [App\Http\Controllers\MessageController::class, 'createPrivateMessage']);
Route::post('/group/chat/insert', [App\Http\Controllers\MessageController::class, 'createGroupMessage']);
Route::post('/read/upsert', [App\Http\Controllers\ReadController::class, 'upsertRead']);
Route::post('/read/group/upsert', [App\Http\Controllers\ReadController::class, 'upsertReadGroup']);
Route::post('/favorite/upsert', [App\Http\Controllers\FavoriteController::class, 'upsertFavorite']);
Route::post('/mypage/edit', [App\Http\Controllers\MypageController::class, 'updateUserDetail']);
Route::post('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'joinRequest']);
Route::post('/notification/reply', [App\Http\Controllers\NotificationController::class, 'sendReply']);
