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
                'departamento' => 'La Libertad',
                'municipio' => 'Tamanique',
                'latitud' => 13.4942000,
                'longitud' => -89.3812000,
                'direccion' => 'Zona costera del departamento de La Libertad',
                'imagen' => 'img/destinos/tunco.jpg',
                'costo_estimado' => 15.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '08:00',
                'hora_cierre' => '17:00',
                'recomendaciones' => 'Llevar ropa cómoda, protector solar y efectivo para consumo local.',
                'estado' => true,
            ],
            [
                'categoria_id' => $montanas?->id,
                'nombre' => 'Volcán El Boquerón',
                'descripcion' => 'Parque natural ubicado en San Salvador, famoso por su cráter, clima fresco y senderos accesibles para visitantes.',
                'ubicacion' => 'San Salvador',
                'departamento' => 'San Salvador',
                'municipio' => 'San Salvador',
                'latitud' => 13.7340000,
                'longitud' => -89.2870000,
                'direccion' => 'Parque Nacional El Boquerón',
                'imagen' => 'img/destinos/boqueron.jpg',
                'costo_estimado' => 5.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '08:00',
                'hora_cierre' => '17:00',
                'recomendaciones' => 'Usar zapatos cómodos y llevar abrigo ligero por el clima fresco.',
                'estado' => true,
            ],
            [
                'categoria_id' => $pueblos?->id,
                'nombre' => 'Suchitoto',
                'descripcion' => 'Pueblo turístico reconocido por sus calles empedradas, arquitectura colonial, arte, cultura y vista al lago Suchitlán.',
                'ubicacion' => 'Cuscatlán',
                'departamento' => 'Cuscatlán',
                'municipio' => 'Suchitoto',
                'latitud' => 13.9381000,
                'longitud' => -89.0278000,
                'direccion' => 'Centro histórico de Suchitoto',
                'imagen' => 'img/destinos/suchitoto.jpg',
                'costo_estimado' => 20.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '08:00',
                'hora_cierre' => '17:00',
                'recomendaciones' => 'Ideal para caminar, tomar fotografías y degustar comida típica.',
                'estado' => true,
            ],
            [
                'categoria_id' => $arqueologicos?->id,
                'nombre' => 'Joya de Cerén',
                'descripcion' => 'Sitio arqueológico declarado Patrimonio de la Humanidad, conocido como la Pompeya de América.',
                'ubicacion' => 'La Libertad',
                'departamento' => 'La Libertad',
                'municipio' => 'San Juan Opico',
                'latitud' => 13.8277000,
                'longitud' => -89.3603000,
                'direccion' => 'San Juan Opico, La Libertad',
                'imagen' => 'img/destinos/joya-de-ceren.jpg',
                'costo_estimado' => 3.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '09:00',
                'hora_cierre' => '16:00',
                'recomendaciones' => 'Consultar horarios actualizados antes de visitar.',
                'estado' => true,
            ],
            [
                'categoria_id' => $naturaleza?->id,
                'nombre' => 'Lago de Coatepeque',
                'descripcion' => 'Lago de origen volcánico reconocido por sus aguas azuladas, restaurantes, miradores y actividades acuáticas.',
                'ubicacion' => 'Santa Ana',
                'departamento' => 'Santa Ana',
                'municipio' => 'El Congo / Coatepeque',
                'latitud' => 13.8643000,
                'longitud' => -89.5450000,
                'direccion' => 'Municipios de El Congo y Coatepeque',
                'imagen' => 'img/destinos/coatepeque.jpg',
                'costo_estimado' => 25.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '08:00',
                'hora_cierre' => '17:00',
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