<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password-cuenta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_estado')->unsigned();
            $table->timestamps();
        });

        Schema::table('password-cuenta', function($table) {
             $table->foreign('id_user')->references('id')->on('users');
             $table->foreign('id_estado')->references('id')->on('estado-password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password-cuenta');
    }
}
