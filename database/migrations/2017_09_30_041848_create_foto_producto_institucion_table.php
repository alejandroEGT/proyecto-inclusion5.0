<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoProductoInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_productos_instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned();
            $table->text('foto');
            $table->timestamps();
        });

        Schema::table('foto_productos_instituciones', function($table) {
            $table->foreign('id_producto')->references('id')->on('productos_instituciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_productos_instituciones');
    }
}
