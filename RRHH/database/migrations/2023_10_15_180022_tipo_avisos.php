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
        Schema::create('tipo_avisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->boolean('urgente')->nullable();
            $table->boolean('usa_whatsapp_avisos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_avisos');
    }
};
