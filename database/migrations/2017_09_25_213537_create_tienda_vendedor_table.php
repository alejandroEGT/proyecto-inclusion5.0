<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaVendedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_vendedor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('id_estado')->unsigned();
            $table->integer('id_vendedor')->unsigned();
            $table->timestamps();
        });

        Schema::table('tienda_vendedor', function($table) {
            $table->foreign('id_estado')->references('id')->on('estado_tienda');
            $table->foreign('id_vendedor')->references('id')->on('vendedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tienda_vendedor');
    }
}
