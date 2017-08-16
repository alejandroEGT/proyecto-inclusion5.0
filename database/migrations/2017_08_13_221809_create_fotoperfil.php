<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoperfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('fotoperfilvendedor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vendedor')->unsigned();
            $table->string('foto');
            $table->timestamps();
        });

        Schema::table('fotoperfilvendedor', function($table) {
            $table->foreign('id_vendedor')->references('id')->on('vendedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fotoperfilvendedor', function (Blueprint $table) {
            //
        });
    }
}
