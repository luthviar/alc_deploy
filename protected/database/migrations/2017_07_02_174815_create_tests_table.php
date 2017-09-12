<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_section_training')->unsigned();
            $table->time('time')->nullable();
            $table->integer('jumlah_soal');
            $table->integer('attemp')->nullable();
            $table->integer('question_per_page')->nullable();
            $table->date('publised');
            $table->integer('min_score')->nullable();
            $table->timestamps();

            $table->foreign('id_section_training')
                ->references('id')
                ->on('section_trainings'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
