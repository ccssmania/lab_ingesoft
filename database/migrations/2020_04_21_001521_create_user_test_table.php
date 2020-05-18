<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_test', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->integer('respuesta');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('test')->onDelete('cascade');

            $table->primary(['user_id', 'test_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_test');
    }
}
