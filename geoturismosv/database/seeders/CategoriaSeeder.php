<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Registra categorías turísticas iniciales.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Playas',
                'descripcion' => 'Destinos turísticos ubicados en zonas costeras de El Salvador.',
                'estado' => true,
            ],
            [
                'nombre' => 'Montañas y Volcanes',
                'descripcion' => 'Lugares naturales ideales para caminatas, miradores y aventura.',
                'estado' => true,
            ],
            [
                'nombre' => 'Pueblos Turísticos',
                'descripcion' => 'Municipios con riqueza cultural, gastronómica e histórica.',
                'estado' => true,
            ],
            [
                'nombre' => 'Sitios Arqueológicos',
                'descripcion' => 'Espacios históricos que conservan parte del patrimonio prehispánico.',
                'estado' => true,
            ],
            [
                'nombre' => 'Lagos y Naturaleza',
                'descripcion' => 'Destinos naturales para descanso, fotografía y convivencia familiar.',
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