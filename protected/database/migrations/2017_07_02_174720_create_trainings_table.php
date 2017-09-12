<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('id_module')->unsigned();
            $table->string('enroll_key')->nullable();
            $table->integer('id_job_family')->unsigned();
            $table->timestamps();

            $table->foreign('id_module')
                ->references('id')
                ->on('modules');

            $table->foreign('id_job_family')
                ->references('id')
                ->on('job_families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
