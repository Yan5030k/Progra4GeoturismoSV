<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega campos de contacto para completar la información turística del destino.
     */
    public function up(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->string('contacto')->nullable()->after('direccion');
            $table->string('telefono')->nullable()->after('contacto');
            $table->string('sitio_web')->nullable()->after('telefono');
        });
    }

    /**
     * Revierte los campos agregados.
     */
    public function down(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->dropColumn([
                'contacto',
                'telefono',
                'sitio_web',
            ]);
        });
    }
};