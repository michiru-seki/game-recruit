<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/friends/{id}', [App\Http\Controllers\FriendController::class, 'getFriends']);
Route::get('/groups/get/userid/{id}', [App\Http\Controllers\GroupController::class, 'getGroupsUseUserId']);
Route::get('/groups/get/groupid/{id}', [App\Http\Controllers\GroupController::class, 'getGroupsUseGroupId']);
Route::get('/group/member/{id}', [App\Http\Controllers\GroupController::class, 'getGroupMember']);
Route::get('/game/styles', [App\Http\Controllers\GameStyleController::class, 'getGameStyles']);

Route::post('/group/edit', [App\Http\Controllers\GroupController::class, 'editGroup']);
