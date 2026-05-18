<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega campos de ubicación avanzada para preparar el módulo de mapa turístico.
     */
    public function up(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->string('departamento', 100)->nullable()->after('ubicacion');
            $table->string('municipio', 100)->nullable()->after('departamento');
            $table->decimal('latitud', 10, 7)->nullable()->after('municipio');
            $table->decimal('longitud', 10, 7)->nullable()->after('latitud');
        });
    }

    /**
     * Revierte los campos agregados.
     */
    public function down(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->dropColumn([
                'departamento',
                'municipio',
                'latitud',
                'longitud',
            ]);
        });
    }
};