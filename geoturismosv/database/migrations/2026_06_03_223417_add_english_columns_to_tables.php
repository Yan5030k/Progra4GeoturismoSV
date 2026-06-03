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
        Schema::table('categorias', function (Blueprint $table) {
            $table->string('nombre_en')->nullable()->after('nombre');
            $table->text('descripcion_en')->nullable()->after('descripcion');
        });

        Schema::table('destinos', function (Blueprint $table) {
            $table->string('nombre_en')->nullable()->after('nombre');
            $table->text('descripcion_en')->nullable()->after('descripcion');
            $table->string('ubicacion_en')->nullable()->after('ubicacion');
            $table->text('recomendaciones_en')->nullable()->after('recomendaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
