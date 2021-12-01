<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadedGroupChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readed_group_chat', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('group_chat_id')->unsigned()->comment('どのグループチャットの誰のメッセージかを示す、group_chatテーブルのidと紐づく');
            $table->integer('read_user_id')->unsigned()->comment('既読のユーザー、usersテーブルのidと紐づく');
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
        Schema::dropIfExists('readed_group_chat');
    }
}
