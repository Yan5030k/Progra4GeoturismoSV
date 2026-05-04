<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Destino;
use Illuminate\Database\Seeder;

class DestinoSeeder extends Seeder
{
    /**
     * Registra destinos turísticos iniciales para la plataforma.
     */
    public function run(): void
    {
        $playas = Categoria::where('nombre', 'Playas')->first();
        $montanas = Categoria::where('nombre', 'Montañas y Volcanes')->first();
        $pueblos = Categoria::where('nombre', 'Pueblos Turísticos')->first();
        $arqueologicos = Categoria::where('nombre', 'Sitios Arqueológicos')->first();
        $naturaleza = Categoria::where('nombre', 'Lagos y Naturaleza')->first();

        $destinos = [
            [
                'categoria_id' => $playas?->id,
                'nombre' => 'Playa El Tunco',
                'descripcion' => 'Uno de los destinos de playa más populares de El Salvador, conocido por su ambiente juvenil, surf, atardeceres y vida nocturna.',
                'ubicacion' => 'Tamanique, La Libertad',
                'direccion' => 'Zona costera del departamento de La Libertad',
                'imagen' => 'img/destinos/tunco.jpg',
                'costo_estimado' => 15.00,
                'horario' => 'Abierto todos los días',
                'recomendaciones' => 'Llevar ropa cómoda, protector solar y efectivo para consumo local.',
                'estado' => true,
            ],
            [
                'categoria_id' => $montanas?->id,
                'nombre' => 'Volcán El Boquerón',
                'descripcion' => 'Parque natural ubicado en San Salvador, famoso por su cráter, clima fresco y senderos accesibles para visitantes.',
                'ubicacion' => 'San Salvador',
                'direccion' => 'Parque Nacional El Boquerón',
                'imagen' => 'img/destinos/boqueron.jpg',
                'costo_estimado' => 5.00,
                'horario' => '8:00 a.m. - 5:00 p.m.',
                'recomendaciones' => 'Usar zapatos cómodos y llevar abrigo ligero por el clima fresco.',
                'estado' => true,
            ],
            [
                'categoria_id' => $pueblos?->id,
                'nombre' => 'Suchitoto',
                'descripcion' => 'Pueblo turístico reconocido por sus calles empedradas, arquitectura colonial, arte, cultura y vista al lago Suchitlán.',
                'ubicacion' => 'Cuscatlán',
                'direccion' => 'Centro histórico de Suchitoto',
                'imagen' => 'img/destinos/suchitoto.jpg',
                'costo_estimado' => 20.00,
                'horario' => 'Abierto todos los días',
                'recomendaciones' => 'Ideal para caminar, tomar fotografías y degustar comida típica.',
                'estado' => true,
            ],
            [
                'categoria_id' => $arqueologicos?->id,
                'nombre' => 'Joya de Cerén',
                'descripcion' => 'Sitio arqueológico declarado Patrimonio de la Humanidad, conocido como la Pompeya de América.',
                'ubicacion' => 'La Libertad',
                'direccion' => 'San Juan Opico, La Libertad',
                'imagen' => 'img/destinos/joya-de-ceren.jpg',
                'costo_estimado' => 3.00,
                'horario' => '9:00 a.m. - 4:00 p.m.',
                'recomendaciones' => 'Consultar horarios actualizados antes de visitar.',
                'estado' => true,
            ],
            [
                'categoria_id' => $naturaleza?->id,
                'nombre' => 'Lago de Coatepeque',
                'descripcion' => 'Lago de origen volcánico reconocido por sus aguas azuladas, restaurantes, miradores y actividades acuáticas.',
                'ubicacion' => 'Santa Ana',
                'direccion' => 'Municipios de El Congo y Coatepeque',
                'imagen' => 'img/destinos/coatepeque.jpg',
                'costo_estimado' => 25.00,
                'horario' => 'Abierto todos los días',
                'recomendaciones' => 'Reservar con anticipación si se visitan restaurantes o alojamientos.',
                'estado' => true,
            ],
        ];

        foreach ($destinos as $destino) {
            if ($destino['categoria_id']) {
                Destino::updateOrCreate(
                    ['nombre' => $destino['nombre']],
                    $destino
                );
            }
        }
    }
}