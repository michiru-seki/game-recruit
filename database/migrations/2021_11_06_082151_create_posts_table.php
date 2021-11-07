<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('group_id')->unsigned()->comment('募集投稿を出したグループのid、groupsテーブルのidと紐づく');
            $table->integer('status_flag')->default(0)->comment('現在募集中か停止中かを示す、0=募集中、1=停止中');
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
        Schema::dropIfExists('posts');
    }
}
