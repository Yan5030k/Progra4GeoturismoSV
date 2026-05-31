<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Destino;
use Illuminate\Database\Seeder;

class DestinoSeeder extends Seeder
{
    public function run(): void
    {
        $playas = Categoria::where('nombre', 'Playas')->first();
        $hoteles = Categoria::where('nombre', 'Hoteles')->first();
        $restaurantes = Categoria::where('nombre', 'Restaurantes')->first();

        $destinos = [
            [
                'categoria_id' => $playas?->id,
                'nombre' => 'Playa El Cuco',
                'descripcion' => 'Playa reconocida de la zona oriental de El Salvador, ideal para descanso, turismo familiar y gastronomía local.',
                'ubicacion' => 'Chirilagua, San Miguel',
                'departamento' => 'San Miguel',
                'municipio' => 'Chirilagua',
                'direccion' => 'Zona costera de Playa El Cuco, Chirilagua, San Miguel.',
                'contacto' => 'Información turística local',
                'telefono' => '2600-0001',
                'sitio_web' => null,
                'costo_estimado' => 15.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '07:00',
                'hora_cierre' => '18:00',
                'recomendaciones' => 'Llevar protector solar, ropa cómoda y visitar durante la mañana.',
                'imagen' => 'img/elcuco_real.png',
                'estado' => true,
                'latitud' => 13.1739,
                'longitud' => -88.1078,
            ],
            [
                'categoria_id' => $restaurantes?->id,
                'nombre' => 'Restaurante Mirador Oriental',
                'descripcion' => 'Restaurante turístico con comida típica salvadoreña y ambiente familiar.',
                'ubicacion' => 'San Miguel',
                'departamento' => 'San Miguel',
                'municipio' => 'San Miguel',
                'direccion' => 'Carretera Panamericana, San Miguel.',
                'contacto' => 'Atención al cliente',
                'telefono' => '2600-0002',
                'sitio_web' => 'https://www.facebook.com/',
                'costo_estimado' => 18.00,
                'dias_atencion' => 'Martes a domingo',
                'hora_apertura' => '10:00',
                'hora_cierre' => '21:00',
                'recomendaciones' => 'Ideal para almuerzos familiares y visitantes que buscan gastronomía local.',
                'imagen' => 'img/pacayal_paisaje.png',
                'estado' => true,
                'latitud' => 13.4830,
                'longitud' => -88.1750,
            ],
            [
                'categoria_id' => $hoteles?->id,
                'nombre' => 'Hotel Vista Azul',
                'descripcion' => 'Hotel turístico orientado a visitantes que buscan alojamiento cerca de la playa.',
                'ubicacion' => 'El Cuco, San Miguel',
                'departamento' => 'San Miguel',
                'municipio' => 'Chirilagua',
                'direccion' => 'Calle principal hacia Playa El Cuco, Chirilagua.',
                'contacto' => 'Recepción del hotel',
                'telefono' => '2600-0003',
                'sitio_web' => 'https://www.example.com',
                'costo_estimado' => 45.00,
                'dias_atencion' => 'Todos los días',
                'hora_apertura' => '00:00',
                'hora_cierre' => '23:59',
                'recomendaciones' => 'Recomendado para visitantes que desean hospedarse cerca de la playa.',
                'imagen' => 'img/elcuco_real.png',
                'estado' => true,
                'latitud' => 13.1760,
                'longitud' => -88.1050,
            ],
        ];

        foreach ($destinos as $destino) {
            Destino::updateOrCreate(
                ['nombre' => $destino['nombre']],
                $destino
            );
        }
    }
}