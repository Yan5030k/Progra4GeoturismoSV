<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla favoritos para guardar destinos favoritos por usuario.
     */
    public function up(): void
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('destino_id')
                ->constrained('destinos')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['user_id', 'destino_id']);
        });
    }

    /**
     * Elimina la tabla favoritos.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};