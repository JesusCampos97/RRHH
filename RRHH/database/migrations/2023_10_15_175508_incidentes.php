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
        Schema::create('indicentes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('user_id');
            $table->time('hora');
            $table->unsignedBigInteger('id_tipo_incidente');
            $table->string('descripcion');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_tipo_incidente')->references('id')->on('tipo_incidentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicentes');
    }
};
