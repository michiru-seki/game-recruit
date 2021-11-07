<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_member', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('group_id')->unsigned()->comment('どのグループのメンバーかを示すid、groupsテーブルのidと紐づく');
            $table->integer('user_id')->unsigned()->comment('グループに所属しているメンバーのid、usersテーブルのidと紐づく');
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
        Schema::dropIfExists('group_member');
    }
}
