<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('user_id')->unsigned()->comment('お気に入りをしたユーザーのid、usersテーブルのidと紐づく');
            $table->integer('post_id')->unsigned()->comment('ユーザーがお気に入りした募集投稿のid、postsテーブルのidと紐づく');
            $table->integer('status_flag')->comment('お気に入り登録中か解除中かを示す、0=登録中、1=解除中');
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
        Schema::dropIfExists('favorite');
    }
}
