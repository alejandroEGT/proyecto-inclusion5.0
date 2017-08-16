<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('id_rol')->unsigned();
            $table->integer('id_sexo')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function($table) {
             $table->foreign('id_rol')->references('id')->on('rol');
             $table->foreign('id_sexo')->references('id')->on('sexo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
