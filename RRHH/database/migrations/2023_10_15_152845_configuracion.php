<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('configuracion_empresa', function (Blueprint $table) {
            $table->id();
            $table->time('hora_ini')->nullable();
            $table->time('hora_fin')->nullable();
            $table->float('tiempo_aviso_jornada')->nullable();
            $table->integer('dias_vacaciones')->unsigned()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_empresa');
    }
};
