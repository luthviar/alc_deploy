<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_forum')->unsigned()->nullable();
            $table->boolean('is_activ');
            $table->string('title');
            $table->string('content')->nullable();
            $table->string('image');
            $table->timestamps();

            $table->foreign('id_forum')
                ->references('id')
                ->on('forums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_sliders');
    }
}
