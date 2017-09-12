<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_news')->unsigned();
            $table->string('title');
            $table->string('content');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')
                ->on('users');

            $table->foreign('id_news')
                ->references('id')
                ->on('beritas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_replies');
    }
}
