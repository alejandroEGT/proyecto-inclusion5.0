<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tienda')->unsigned()->index();
            $table->integer('id_foto')->unsigned()->index();
            $table->string('nombre');
            $table->string('descripcion');
        });
        
        Schema::table('servicios', function (Blueprint $table) {
             $table->foreign('id_tienda')->references('id')->on('tiendas');
             $table->foreign('id_foto')->references('id')->on('foto_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
