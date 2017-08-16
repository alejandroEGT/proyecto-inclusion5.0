<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario-institucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('telefono');
            $table->integer('id_institucion')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->timestamps();
        });
        Schema::table('usuario-institucion', function($table) {
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_institucion')->references('id')->on('institucion');
            $table->foreign('id_area')->references('id')->on('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario-institucion');
    }
}
