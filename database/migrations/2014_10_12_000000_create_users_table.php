<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->string('user_name')->comment('ユーザー名');
            $table->string('password')->comment('パスワード');
            $table->string('icon', '256')->nullable()->comment('ユーザーのアイコン');
            $table->string('game')->nullable()->comment('ユーザーの主なゲーム');
            $table->string('introduction')->nullable()->comment('自己紹介文');
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
        Schema::dropIfExists('users');
    }
}
