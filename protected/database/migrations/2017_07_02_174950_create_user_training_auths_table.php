<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrainingAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_training_auths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();            
            $table->integer('id_training')->unsigned();
            $table->boolean('auth');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')
                ->on('users');

            $table->foreign('id_training')
                ->references('id')
                ->on('trainings');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_training_auths');
    }
}
