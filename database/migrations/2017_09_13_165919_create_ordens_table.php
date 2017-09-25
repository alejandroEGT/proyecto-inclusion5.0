<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned()->index();
            $table->integer('id_estado')->unsigned()->index();
            $table->integer('id_pago')->unsigned()->index();
            $table->string('codigo');
            $table->integer('total');
            $table->dateTime('fecha');
            $table->timestamps();
            
        });
        Schema::table('ordenes', function (Blueprint $table){

            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_estado')->references('id')->on('estado_ordenes');
            $table->foreign('id_pago')->references('id')->on('pagos');

        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
