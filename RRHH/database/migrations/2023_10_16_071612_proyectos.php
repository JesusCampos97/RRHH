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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estado');
            $table->string('nombre');
            $table->float('presupuesto')->nullable();
            $table->unsignedBigInteger('id_documento');
            $table->unsignedBigInteger('id_empresa');
            $table->date('fecha_ini')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->foreign('id_documento')->references('id')->on('documentos');
            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->foreign('id_estado')->references('id')->on('estados_proyectos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
