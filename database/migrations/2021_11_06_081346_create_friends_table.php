<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('user_id')->unsigned()->comment('usersテーブルのidと紐づく');
            $table->integer('friend_user_id')->unsigned()->comment('users_idとの友達を示す、usersテーブルのidと紐づく');
            $table->integer('private_room_id')->unsigned()->comment('友達とのチャットのルームid、private_roomsテーブルのidと紐づく');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
