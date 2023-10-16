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
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->time('hora_ini')->nullable();
            $table->time('hora_fin')->nullable();
            $table->float('total_horas')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_descanso');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_descanso')->references('id')->on('descansos_jornada');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('jornadas');
    }
};
