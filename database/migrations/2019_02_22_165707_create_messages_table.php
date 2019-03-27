<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
//            $table->unsignedInteger('friend_id')->comment('自分と相手の組み合わせが書かれたfriendsテーブルのid');
            $table->unsignedInteger('room_id')->comment('どのチャット・ルームか？');
            $table->unsignedInteger('user_id')->comment('発言したユーザID');
            $table->text('text')->comment('発言した内容');
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
        Schema::dropIfExists('messages');
    }
}
