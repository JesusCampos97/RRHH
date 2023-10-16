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
        Schema::create('epis_equipos_asignados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('user_id_asignado');
            $table->time('hora');
            $table->boolean('entregado');
            $table->unsignedBigInteger('id_tipo_epis');
            $table->unsignedBigInteger('id_documento');
            $table->unsignedBigInteger('user_id_proporcionado');


            $table->foreign('user_id_asignado')->references('id')->on('users');
            $table->foreign('user_id_proporcionado')->references('id')->on('users');
            $table->foreign('id_tipo_epis')->references('id')->on('tipo_epis');
            $table->foreign('id_documento')->references('id')->on('documentos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epis_equipos_asignados');
    }
};
