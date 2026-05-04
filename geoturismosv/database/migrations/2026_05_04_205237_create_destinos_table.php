<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla destinos para almacenar lugares turísticos.
     */
    public function up(): void
    {
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');

            $table->string('nombre', 150);
            $table->text('descripcion');
            $table->string('ubicacion', 150);
            $table->string('direccion', 255)->nullable();
            $table->string('imagen')->nullable();
            $table->decimal('costo_estimado', 8, 2)->default(0);
            $table->string('horario', 150)->nullable();
            $table->text('recomendaciones')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla destinos.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinos');
    }
};