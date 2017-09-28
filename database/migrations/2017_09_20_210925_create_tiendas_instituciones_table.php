<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasInstitucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tiendas_instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('id_estado')->unsigned();
            $table->integer('id_institucion')->unsigned();
            $table->timestamps();
        });

        Schema::table('tiendas_instituciones', function($table) {
            
            $table->foreign('id_estado')->references('id')->on('estado_tienda');
            $table->foreign('id_institucion')->references('id')->on('institucion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
