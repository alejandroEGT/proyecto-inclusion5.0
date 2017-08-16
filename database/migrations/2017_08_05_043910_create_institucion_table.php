<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rut');
            $table->string('nombre');
            $table->string('razonSocial');
            $table->integer('telefono1');
            $table->integer('telefono2');
            $table->text('direccion');
            $table->text('logo');
            $table->string('correo');
            $table->string('clave');
            $table->timestamps();
        });

        Schema::table('institucion', function($table) {
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institucion');
    }
}
