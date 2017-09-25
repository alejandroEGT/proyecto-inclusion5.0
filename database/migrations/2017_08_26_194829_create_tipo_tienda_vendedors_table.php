<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoTiendaVendedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_tienda_vendedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vendedor')->unsigned();
            $table->integer('id_tipo_tienda')->unsigned();
            $table->timestamps();
        });
        Schema::table('tipo_tienda_vendedores', function(Blueprint $table){
            $table->foreign('id_vendedor')->references('id')->on('vendedor');
            $table->foreign('id_tipo_tienda')->references('id')->on('tipo_tiendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_tienda_vendedores');
    }
}
