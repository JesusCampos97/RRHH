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
        Schema::table('descansos_jornada', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tipo_descanso')->nullable();

            $table->foreign('id_tipo_descanso')->references('id')->on('tipos_descansos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
