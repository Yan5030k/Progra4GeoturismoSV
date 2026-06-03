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
                'nombre_en' => 'Beaches',
                'descripcion' => 'Destinos costeros ideales para descanso, recreación y turismo familiar.',
                'descripcion_en' => 'Coastal destinations ideal for relaxation, recreation, and family tourism.',
                'estado' => true,
            ],
            [
                'nombre' => 'Montañas y naturaleza',
                'nombre_en' => 'Mountains and nature',
                'descripcion' => 'Lugares naturales, volcanes, miradores y espacios para aventura.',
                'descripcion_en' => 'Natural places, volcanoes, viewpoints, and spaces for adventure.',
                'estado' => true,
            ],
            [
                'nombre' => 'Restaurantes',
                'nombre_en' => 'Restaurants',
                'descripcion' => 'Establecimientos gastronómicos recomendados para visitantes nacionales y extranjeros.',
                'descripcion_en' => 'Recommended gastronomic establishments for national and foreign visitors.',
                'estado' => true,
            ],
            [
                'nombre' => 'Hoteles',
                'nombre_en' => 'Hotels',
                'descripcion' => 'Opciones de alojamiento para turistas dentro de El Salvador.',
                'descripcion_en' => 'Accommodation options for tourists within El Salvador.',
                'estado' => true,
            ],
            [
                'nombre' => 'Centros recreativos',
                'nombre_en' => 'Recreation centers',
                'descripcion' => 'Espacios familiares y recreativos para visitar en diferentes zonas del país.',
                'descripcion_en' => 'Family and recreational spaces to visit in different areas of the country.',
                'estado' => true,
            ],
            [
                'nombre' => 'Sitios culturales',
                'nombre_en' => 'Cultural sites',
                'descripcion' => 'Lugares históricos, arqueológicos y culturales de interés turístico.',
                'descripcion_en' => 'Historical, archaeological, and cultural places of tourist interest.',
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