<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examen_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_pregunta');
            $table->string('pregunta');
            $table->string('respuesta_1');
            $table->string('respuesta_2');
            $table->string('respuesta_3');
            $table->string('respuesta_4');
            $table->string('respuesta_correcta');
            $table->string('imagen')->nullable();
            $table->timestamps();
            
            $table->foreign('examen_id')->references('id')->on('examen')->onDelete('cascade');


        
        });
        /*
        Schema::table('test', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('examen_id')->references('id')->on('examen')->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test');
    }
}
