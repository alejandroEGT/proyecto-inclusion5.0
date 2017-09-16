<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_carros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_carro')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->timestamps();
        });
        Schema::table('detalle_carros', function($table) {
             $table->foreign('id_carro')->references('id')->on('carros');
             $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_carros');
    }
}
