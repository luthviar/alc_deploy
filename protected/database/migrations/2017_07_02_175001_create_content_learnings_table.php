<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_learnings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_section')->unsigned();
            $table->string('url');
            $table->timestamps();

            $table->foreign('id_section')
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
        Schema::dropIfExists('content_learnings');
    }
}
