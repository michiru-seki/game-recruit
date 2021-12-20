<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('user_id')->unsigned()->comment('募集を出しているグループリーダーのid');
            $table->integer('request_user_id')->unsigned()->comment('リクエストを出したユーザーid');
            $table->integer('post_subscription_id')->unsigned()->nullable()->comment('応募id、post_subscriptionsのidと紐づく');
            $table->integer('read_status')->default(0)->comment('未読または既読を管理する、0=未読、1=既読');
            $table->string('message')->nullable()->comment('通知用のメッセージ');
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
        Schema::dropIfExists('notifications');
    }
}
