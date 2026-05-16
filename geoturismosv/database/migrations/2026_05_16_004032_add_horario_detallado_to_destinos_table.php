<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega campos más ordenados para los días y horas de atención del destino.
     */
    public function up(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->text('dias_atencion')->nullable()->after('costo_estimado');
            $table->time('hora_apertura')->nullable()->after('dias_atencion');
            $table->time('hora_cierre')->nullable()->after('hora_apertura');
        });
    }

    /**
     * Elimina los campos de horario detallado si se revierte la migración.
     */
    public function down(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->dropColumn([
                'dias_atencion',
                'hora_apertura',
                'hora_cierre',
            ]);
        });
    }
};