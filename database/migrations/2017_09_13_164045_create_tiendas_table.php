<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estado')->unsigned();
            $table->integer('id_tipo')->unsigned();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        Schema::table('tiendas', function($table) {
            
            $table->foreign('id_estado')->references('id')->on('estado_tienda');
            $table->foreign('id_tipo')->references('id')->on('tipo_tiendas');
        });
   

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiendas');
    }
}
