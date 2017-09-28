<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioInstitucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_foto')->unsigned()->index();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        Schema::table('servicio_instituciones', function (Blueprint $table) {
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
        Schema::dropIfExists('servicio_instituciones');
    }
}
