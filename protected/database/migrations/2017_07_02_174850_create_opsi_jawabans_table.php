<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpsiJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opsi_jawabans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_question')->unsigned();
            $table->string('isi_opsi');
            $table->boolean('is_true');
            $table->timestamps();

            $table->foreign('id_question')
                ->references('id')
                ->on('questions'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opsi_jawabans');
    }
}
