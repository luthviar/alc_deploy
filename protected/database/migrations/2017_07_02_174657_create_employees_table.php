<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_personnel')->unsigned();
            $table->string('nip');
            $table->integer('struktur')->unsigned();
            $table->integer('level_position')->unsigned();
            $table->timestamps();

            $table->foreign('id_personnel')
                ->references('id')
                ->on('personnels');

            $table->foreign('struktur')
                ->references('id')
                ->on('struktur_organisasis');

            $table->foreign('level_position')
                ->references('id')
                ->on('level_positions');                
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
