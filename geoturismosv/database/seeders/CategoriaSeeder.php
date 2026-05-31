<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Categorías base para organizar los destinos turísticos.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Playas',
                'descripcion' => 'Destinos costeros ideales para descanso, recreación y turismo familiar.',
                'estado' => true,
            ],
            [
                'nombre' => 'Montañas y naturaleza',
                'descripcion' => 'Lugares naturales, volcanes, miradores y espacios para aventura.',
                'estado' => true,
            ],
            [
                'nombre' => 'Restaurantes',
                'descripcion' => 'Establecimientos gastronómicos recomendados para visitantes nacionales y extranjeros.',
                'estado' => true,
            ],
            [
                'nombre' => 'Hoteles',
                'descripcion' => 'Opciones de alojamiento para turistas dentro de El Salvador.',
                'estado' => true,
            ],
            [
                'nombre' => 'Centros recreativos',
                'descripcion' => 'Espacios familiares y recreativos para visitar en diferentes zonas del país.',
                'estado' => true,
            ],
            [
                'nombre' => 'Sitios culturales',
                'descripcion' => 'Lugares históricos, arqueológicos y culturales de interés turístico.',
                'estado' => true,
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                $categoria
            );
        }
    }
}