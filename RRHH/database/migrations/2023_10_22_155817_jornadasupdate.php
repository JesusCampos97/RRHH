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
        Schema::table('JORNADAS', function (Blueprint $table) {
            $table->unsignedBigInteger('id_descanso')->nullable()->change();  
            $table->decimal('lat',10,7)->change();  
            $table->decimal('lng',11,7)->change();  

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
