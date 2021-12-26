<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->string('group_name', '256')->comment('グループ名');
            $table->integer('leader_id')->unsigned()->comment('グループの親のID、usersテーブルのidと紐づく');
            $table->string('icon', '256')->nullable()->comment('グループのアイコン');
            $table->integer('participants')->comment('参加人数');
            $table->integer('recruitment')->comment('募集人数');
            $table->string('description', '5000')->comment('グループの説明');
            $table->integer('style_id')->unsigned()->comment('グループのスタイル、スタイルテーブルのidと紐づく');
            $table->integer('game_id')->unsigned()->comment('グループで活動するゲーム、ゲームテーブルのidと紐づく');
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
        Schema::dropIfExists('groups');
    }
}
