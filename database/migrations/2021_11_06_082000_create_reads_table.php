<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reads', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('user_id')->unsigned()->comment('usersテーブルのidと紐づく');
            $table->integer('friend_user_id')->unsigned()->nullable()->comment('users_idとの友達を示す、usersテーブルのidと紐づく');
            $table->integer('group_id')->unsigned()->nullable()->comment('groupsテーブルのidと紐づく');
            $table->dateTime('watch_date')->comment('プライベートまたはグループチャットルームを開いた時間を保存する');
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
        Schema::dropIfExists('reads');
    }
}
