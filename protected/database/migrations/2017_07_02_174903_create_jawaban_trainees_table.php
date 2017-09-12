<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJawabanTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_trainees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_question')->unsigned();
            $table->integer('isi_jawaban')->unsigned();
            $table->integer('skor')->nullable();
            $table->timestamps();

            $table->foreign('id_question')
                ->references('id')
                ->on('questions'); 
            $table->foreign('isi_jawaban')
                ->references('id')
                ->on('opsi_jawabans'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_trainees');
    }
}
