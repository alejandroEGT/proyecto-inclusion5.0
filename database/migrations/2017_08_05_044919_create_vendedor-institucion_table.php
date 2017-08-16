<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendedorInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedor-institucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vendedor')->unsigned();
            $table->integer('id_institucion')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->timestamps();
        });
         Schema::table('vendedor-institucion', function($table) {
            $table->foreign('id_vendedor')->references('id')->on('vendedor');
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
        Schema::dropIfExists('vendedor-institucion');
    }
}
