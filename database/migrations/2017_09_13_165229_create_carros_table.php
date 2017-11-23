<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned()->index();
            $table->integer('id_estado')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('carros', function(Blueprint $table){
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_estado')->references('id')->on('estado_carros');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
    }
}
