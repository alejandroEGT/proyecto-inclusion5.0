<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaProductoInstitucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_producto_instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned();
            $table->integer('id_tienda')->unsigned();
            $table->integer('id_estado')->unsigned();
            $table->timestamps();
        });

         Schema::table('tienda_producto_instituciones', function($table) {
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_tienda')->references('id')->on('tiendas_instituciones');
            $table->foreign('id_estado')->references('id')->on('estado_tienda_producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tienda_producto_instituciones');
    }
}
