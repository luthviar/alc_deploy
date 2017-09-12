<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_training')->unsigned();
            $table->integer('id_type')->unsigned();
            $table->integer('sequence');
            $table->timestamps();

            $table->foreign('id_training')
                ->references('id')
                ->on('trainings');

            $table->foreign('id_type')
                ->references('id')
                ->on('section_training_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_trainings');
    }
}
