<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosServiciosPerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_servicios_instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_servicio')->unsigned();
            $table->text('foto');
            //
        });

        Schema::table('foto_servicios_instituciones', function($table) {
            $table->foreign('id_servicio')->references('id')->on('servicio_instituciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
