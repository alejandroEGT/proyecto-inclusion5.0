<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockMinimoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock-minimo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_institucion')->unsigned();
            $table->integer('cantidad_minima')->nullable();
            $table->timestamps();
        });

         Schema::table('stock-minimo', function($table) {
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
        Schema::dropIfExists('stock-minimo');
    }
}
