<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_rooms', function (Blueprint $table) {
            $table->increments('id')->comment('プライマリーキー');
            $table->integer('first_user_id')->unsigned()->comment('usersテーブルのidと紐づく');
            $table->integer('second_user_id')->unsigned()->comment('usersテーブルのidと紐づく');
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
        Schema::dropIfExists('private_rooms');
    }
}
