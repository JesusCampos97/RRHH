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
        Schema::create('buzon_interno', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('user_id_emisor');
            $table->unsignedBigInteger('user_id_receptor');
            $table->boolean('leido');
            $table->date('fecha_leido')->nullable();
            $table->time('hora_leido')->nullable();
            $table->string('mensaje');
            $table->unsignedBigInteger('id_tipo_aviso');


            $table->foreign('user_id_emisor')->references('id')->on('users');
            $table->foreign('user_id_receptor')->references('id')->on('users');
            $table->foreign('id_tipo_aviso')->references('id')->on('tipo_avisos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buzon_interno');
    }
};
