<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoperfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
          public function up()
    {
        Schema::create('fotoperfil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('foto');
            $table->timestamps();
        });

        Schema::table('fotoperfil', function($table) {
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fotoperfil', function (Blueprint $table) {
            //
        });
    }
}
