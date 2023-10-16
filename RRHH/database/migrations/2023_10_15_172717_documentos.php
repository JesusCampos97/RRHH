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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->time('hora')->nullable();
            $table->unsignedBigInteger('id_tipo_doc');
            $table->binary('documento')->nullable();
            $table->string('ruta_tmp')->nullable();

            $table->foreign('id_tipo_doc')->references('id')->on('tipo_documentos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
