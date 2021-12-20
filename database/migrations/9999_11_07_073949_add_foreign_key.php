<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('users');
            // $table->foreign('group_chat_id')->references('id')->on('group_chat');
            $table->foreign('style_id')->references('id')->on('mst_style');
            $table->foreign('game_id')->references('id')->on('mst_game');
        });

        Schema::table('group_member', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('friends', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('friend_user_id')->references('id')->on('users');
            $table->foreign('private_room_id')->references('id')->on('private_rooms');
        });

        Schema::table('private_chat', function (Blueprint $table) {
            $table->foreign('private_room_id')->references('id')->on('private_rooms');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('reads', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('friend_user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('users');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('favorite', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
        });

        Schema::table('post_subscriptions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('request_user_id')->references('id')->on('users');
            $table->foreign('post_subscription_id')->references('id')->on('post_subscriptions');
        });
        
        Schema::table('group_chat', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('user_id')->references('id')->on('users');
        });
        
        Schema::table('readed_group_chat', function (Blueprint $table) {
            $table->foreign('group_chat_id')->references('id')->on('group_chat');
            $table->foreign('read_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
