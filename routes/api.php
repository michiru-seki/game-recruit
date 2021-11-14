<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/friends/{id}', [App\Http\Controllers\FriendController::class, 'getFriends']);
Route::get('/groups/userid/{id}', [App\Http\Controllers\GroupController::class, 'getGroupsUseUserId']);
Route::get('/groups/groupid/{id}', [App\Http\Controllers\GroupController::class, 'getGroupsUseGroupId']);
Route::get('/group/member/{id}', [App\Http\Controllers\GroupController::class, 'getGroupMember']);
Route::get('/game/styles', [App\Http\Controllers\GameStyleController::class, 'getGameStyles']);
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'getPost']);
Route::get('/post/detail/all', [App\Http\Controllers\PostController::class, 'getPostDetail']);

Route::post('/group/edit', [App\Http\Controllers\GroupController::class, 'editGroup']);
Route::post('/post/upsert', [App\Http\Controllers\PostController::class, 'upsertPost']);
