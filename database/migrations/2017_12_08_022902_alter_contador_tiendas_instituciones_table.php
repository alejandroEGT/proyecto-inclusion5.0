<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterContadorTiendasInstitucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contador_tiendas_instituciones', function (Blueprint $table) {
            
            $table->string('ciudad')->nullable();
            $table->string('region')->nullable();
            $table->string('pais')->nullable();
            $table->string('codigo_pais')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contador_tiendas_instituciones', function (Blueprint $table) {
            //
        });
    }
}
