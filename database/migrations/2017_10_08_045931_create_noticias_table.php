<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->text('texto');
            $table->text('foto');
            $table->integer('id_estado')->unsigned();
            $table->integer('id_institucion')->unsigned();
            $table->timestamps();
        });

        Schema::table('noticias', function($table) {
            $table->foreign('id_estado')->references('id')->on('estado_noticias');
            $table->foreign('id_institucion')->references('id')->on('institucion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
