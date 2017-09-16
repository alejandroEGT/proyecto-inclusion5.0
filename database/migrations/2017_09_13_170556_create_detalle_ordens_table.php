<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_orden')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->string('producto');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->timestamps();
        });
        Schema::table('detalle_ordenes', function($table) {
             $table->foreign('id_producto')->references('id_producto')->on('detalle_carros');            
            $table->foreign('id_orden')->references('id')->on('ordenes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ordenes');
    }
}
