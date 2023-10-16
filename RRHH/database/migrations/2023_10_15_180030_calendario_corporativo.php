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
        Schema::create('calendario_corporativo', function (Blueprint $table) {
            $table->id();
            $table->integer('anyo')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedBigInteger('id_evento');
            $table->boolean('todo_el_dia')->nullable();

            $table->foreign('id_evento')->references('id')->on('tipo_eventos');
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
