<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_subscriptions', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('user_id')->unsigned()->comment('募集投稿に応募したユーザーのid、usersテーブルのidと紐づく');
            $table->integer('post_id')->unsigned()->comment('募集投稿を出しているグループのid、groupsテーブルのidと紐づく');
            $table->integer('status_flag')->comment('参加許可または拒否を示す、0=許可、1=拒否、2=保留');
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
        Schema::dropIfExists('post_subscriptions');
    }
}
