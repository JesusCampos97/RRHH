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
        Schema::create('ausencias_trabajadores', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->time('hora_ini')->nullable();
            $table->time('hora_fin')->nullable();
            $table->unsignedBigInteger('id_tipo_ausencia');

            $table->foreign('id_tipo_ausencia')->references('id')->on('tipo_ausencias');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencias_trabajadores');
    }
};
