<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContadorTiendaInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contador_tiendas_instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tienda')->unsigned();
            $table->text('laravel_session');
            $table->bigInteger('cantidad');
            $table->timestamps();
            $table->foreign('id_tienda')->references('id')->on('tiendas_instituciones');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contador_tiendas_instituciones');
    }
}
