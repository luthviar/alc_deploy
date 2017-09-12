<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_pre_test')->unsigned();
            $table->integer('id_post_test')->unsigned();
            $table->integer('pre_test_score')->nullable();
            $table->integer('post_test_score')->nullable();
            $table->timestamps();

            $table->foreign('id_pre_test')
                ->references('id')
                ->on('tests'); 
            $table->foreign('id_post_test')
                ->references('id')
                ->on('tests');
            $table->foreign('id_user')
                ->references('id')
                ->on('users');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tests');
    }
}
