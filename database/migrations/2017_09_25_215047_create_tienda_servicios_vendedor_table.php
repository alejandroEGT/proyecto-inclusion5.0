<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaServiciosVendedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_servicios_vendedor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_servicio')->unsigned();
            $table->integer('id_tienda')->unsigned();
            $table->integer('id_estado')->unsigned();
            $table->timestamps();
        });

        Schema::table('tienda_servicios_vendedor', function($table) {

            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->foreign('id_tienda')->references('id')->on('tienda_vendedor');
            $table->foreign('id_estado')->references('id')->on('estado_tienda_servicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tienda_servicios_vendedor');
    }
}
