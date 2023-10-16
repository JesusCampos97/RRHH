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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('telefono')->nullable();  
            $table->unsignedBigInteger('id_empresa')->nullable();  
            $table->integer('num_vacaciones_pendientes')->nullable();  
            $table->string('llavero')->nullable();  
            $table->unsignedBigInteger('id_puesto_trabajo')->nullable();  

            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->foreign('id_puesto_trabajo')->references('id')->on('tipo_puestos_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        /*Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('archivo');
        });*/
    }
};
