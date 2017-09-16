<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('foto_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_servicio')->unsigned();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::table('foto_servicios', function($table) {
            $table->foreign('id_servicio')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_servicios');
    }
}
