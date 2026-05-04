<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla categorias para clasificar los destinos turísticos.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->text('descripcion');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla categorias.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};