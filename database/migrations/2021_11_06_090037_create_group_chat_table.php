<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chat', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('group_id')->unsigned()->comment('groupsテーブルのidと紐づく');
            $table->integer('user_id')->unsigned()->comment('誰のメッセージかを示す、usersテーブルのidと紐づく');
            $table->string('message')->nullable()->comment('メッセージ');
            $table->string('image')->nullable()->comment('画像のパス');
            $table->string('movie')->nullable()->comment('動画のパス');
            $table->integer('read_status')->default(0)->comment('未読または既読を管理する、0=未読、1=既読');
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
        Schema::dropIfExists('group_chat');
    }
}
