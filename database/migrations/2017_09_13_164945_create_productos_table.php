<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria')->unsigned();
            $table->string('nombre');
            $table->integer('precio');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->integer('vista');
            $table->timestamps();
        });

        Schema::table('productos', function (Blueprint $table) {
             $table->foreign('id_categoria')->references('id')->on('categoria_productos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
