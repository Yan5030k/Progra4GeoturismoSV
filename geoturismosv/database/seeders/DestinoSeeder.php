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
            [
                'categoria_id' => $montanas?->id,
                'nombre' => 'Volcán de Chaparrastique',
                'descripcion' => 'El Volcán de San Miguel, también conocido como Chaparrastique, es uno de los volcanes más activos de El Salvador. Ofrece a los montañistas una de las escaladas más desafiantes del país con vistas impresionantes de la zona oriental.',
                'ubicacion' => 'San Miguel, San Miguel',
                'departamento' => 'San Miguel',
                'municipio' => 'San Miguel',
                'latitud' => 13.4316,
                'longitud' => -88.2713,
                'direccion' => 'Volcán de San Miguel, San Miguel',
                'imagen' => 'images/chaparrastique_real.png',
                'costo_estimado' => 0.00,
                'dias_atencion' => 'Acceso público permanente',
                'hora_apertura' => null,
                'hora_cierre' => null,
                'recomendaciones' => 'Llevar abundante agua, bloqueador solar, ropa cómoda, botas de montaña y preferiblemente ir acompañado de un guía local.',
                'estado' => true,
            ],
            [
                'categoria_id' => $playas?->id,
                'nombre' => 'Playa El Cuco',
                'descripcion' => 'Una de las playas más hermosas y populares del oriente salvadoreño. Famosa por sus extensas arenas oscuras, su oleaje constante ideal para el surf y su ambiente relajado. Excelente lugar para disfrutar de los mariscos frescos.',
                'ubicacion' => 'Chirilagua, San Miguel',
                'departamento' => 'San Miguel',
                'municipio' => 'Chirilagua',
                'latitud' => 13.1743,
                'longitud' => -88.1108,
                'direccion' => 'Playa El Cuco, Chirilagua',
                'imagen' => 'images/elcuco_real.png',
                'costo_estimado' => 0.00,
                'dias_atencion' => 'Acceso público permanente',
                'hora_apertura' => null,
                'hora_cierre' => null,
                'recomendaciones' => 'Llevar bloqueador solar, repelente para mosquitos y disfrutar del atardecer.',
                'estado' => true,
            ],
            [
                'categoria_id' => $naturaleza?->id,
                'nombre' => 'Laguna de Alegría',
                'descripcion' => 'Conocida como "La Esmeralda de América" por el poeta Gabriela Mistral, es una laguna de origen volcánico con aguas color turquesa intenso ricas en azufre, ubicada en el cráter del volcán Tecapa.',
                'ubicacion' => 'Alegría, Usulután',
                'departamento' => 'Usulután',
                'municipio' => 'Alegría',
                'latitud' => 13.4925,
                'longitud' => -88.4933,
                'direccion' => 'Laguna de Alegría, Volcán Tecapa',
                'imagen' => 'images/alegria_real.png',
                'costo_estimado' => 1.50,
                'dias_atencion' => 'Lunes a Domingo',
                'hora_apertura' => '08:00',
                'hora_cierre' => '17:00',
                'recomendaciones' => 'Llevar suéter ya que el clima es fresco, y aprovechar para conocer el pueblo de Alegría que está muy cerca.',
                'estado' => true,
            ],
            [
                'categoria_id' => $playas?->id,
                'nombre' => 'Golfo de Fonseca',
                'descripcion' => 'Un majestuoso golfo en el Océano Pacífico compartido por El Salvador, Honduras y Nicaragua. Se pueden realizar tours en lancha para visitar islas como Meanguera del Golfo, Zacatillo y avistar fauna marina.',
                'ubicacion' => 'La Unión, La Unión',
                'departamento' => 'La Unión',
                'municipio' => 'La Unión',
                'latitud' => 13.3369,
                'longitud' => -87.8430,
                'direccion' => 'Muelle de La Unión, La Unión',
                'imagen' => 'images/golfo_real.png',
                'costo_estimado' => 15.00,
                'dias_atencion' => 'Lunes a Domingo',
                'hora_apertura' => '07:00',
                'hora_cierre' => '18:00',
                'recomendaciones' => 'Contratar un tour en lancha desde el muelle de La Unión. Llevar protector solar, gorra y cámara.',
                'estado' => true,
            ],
            [
                'categoria_id' => $naturaleza?->id,
                'nombre' => 'Laguna El Pacayal',
                'descripcion' => 'La Laguna Seca El Pacayal, ubicada en la cima del Volcán Chinameca a una elevación de 1,350 m s.n.m., es una enorme caldera volcánica completamente seca. El inmenso fondo y las laderas de este cráter están cubiertos por una exuberante vegetación y extensos bosques dedicados al cultivo del café. Su origen se remonta a unos 59,000 años atrás como consecuencia de una erupción cataclísmica, siendo ideal para el ecoturismo, senderismo de aventura y observación de fumarolas.',
                'ubicacion' => 'Chinameca, San Miguel',
                'departamento' => 'San Miguel',
                'municipio' => 'Chinameca',
                'latitud' => 13.478,
                'longitud' => -88.330,
                'direccion' => 'Laguna El Pacayal, Chinameca',
                'imagen' => 'images/pacayal_paisaje.png',
                'costo_estimado' => 0.00,
                'dias_atencion' => 'Acceso público permanente',
                'hora_apertura' => null,
                'hora_cierre' => null,
                'recomendaciones' => 'Es indispensable realizar el recorrido con el acompañamiento de un guía local experimentado. Utilizar calzado con buen nivel de tracción, ropa adecuada para el clima, protección solar y llevar abundante hidratación para la exigencia física del ascenso.',
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