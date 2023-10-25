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
            $table->unsignedBigInteger('id_jornada')->nullable();  
            $table->decimal('lat',10,7)->change();  
            $table->decimal('lng',11,7)->change();

            $table->foreign('id_jornada')->references('id')->on('jornadas');
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
