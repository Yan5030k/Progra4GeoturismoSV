-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2026 a las 13:43:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `geoturismosv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_en` varchar(255) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `descripcion_en` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `nombre_en`, `descripcion`, `descripcion_en`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Playas', NULL, 'Destinos costeros ideales para descanso, recreación y turismo familiar.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(2, 'Montañas y naturaleza', NULL, 'Lugares naturales, volcanes, miradores y espacios para aventura.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(3, 'Restaurantes', NULL, 'Establecimientos gastronómicos recomendados para visitantes nacionales y extranjeros.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(4, 'Hoteles', NULL, 'Opciones de alojamiento para turistas dentro de El Salvador.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(5, 'Centros recreativos', NULL, 'Espacios familiares y recreativos para visitar en diferentes zonas del país.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(6, 'Sitios culturales', NULL, 'Lugares históricos, arqueológicos y culturales de interés turístico.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `nombre_en` varchar(255) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `descripcion_en` text DEFAULT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `ubicacion_en` varchar(255) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `latitud` decimal(10,7) DEFAULT NULL,
  `longitud` decimal(10,7) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `direccion_en` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `contacto_en` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `sitio_web` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `costo_estimado` decimal(8,2) NOT NULL DEFAULT 0.00,
  `dias_atencion` text DEFAULT NULL,
  `dias_atencion_en` varchar(255) DEFAULT NULL,
  `hora_apertura` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `horario` varchar(150) DEFAULT NULL,
  `horario_en` varchar(255) DEFAULT NULL,
  `recomendaciones` text DEFAULT NULL,
  `recomendaciones_en` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`id`, `categoria_id`, `nombre`, `nombre_en`, `descripcion`, `descripcion_en`, `ubicacion`, `ubicacion_en`, `departamento`, `municipio`, `latitud`, `longitud`, `direccion`, `direccion_en`, `contacto`, `contacto_en`, `telefono`, `sitio_web`, `imagen`, `costo_estimado`, `dias_atencion`, `dias_atencion_en`, `hora_apertura`, `hora_cierre`, `horario`, `horario_en`, `recomendaciones`, `recomendaciones_en`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'Playa El Tunco', NULL, 'Uno de los destinos de playa más populares de El Salvador, conocido por su ambiente juvenil, surf, atardeceres y vida nocturna.', NULL, 'Tamanique, La Libertad', NULL, 'La Libertad', 'Tamanique', 13.4942000, -89.3812000, 'Zona costera del departamento de La Libertad', NULL, 'Información turística local', NULL, '2600-0101', NULL, 'img/destinos/tunco.jpg', 15.00, 'Sábado y domingo', NULL, '12:48:00', '05:50:00', 'Abierto todos los días', NULL, 'Llevar ropa cómoda, protector solar y efectivo para consumo local.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(2, 2, 'Volcán El Boquerón', NULL, 'Parque natural ubicado en San Salvador, famoso por su cráter, clima fresco y senderos accesibles para visitantes.', NULL, 'San Salvador', NULL, 'San Salvador', 'San Salvador', 13.7340000, -89.2870000, 'Parque Nacional El Boquerón', NULL, 'Administración del parque', NULL, '2600-0103', 'https://meet.google.com/landing?authuser=1', 'img/destinos/boqueron.jpg', 5.00, 'Todos los días', NULL, '08:00:00', '17:00:00', '8:00 a.m. - 5:00 p.m.', NULL, 'Usar zapatos cómodos y llevar abrigo ligero por el clima fresco.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 10:09:49'),
(3, 6, 'Suchitoto', NULL, 'Pueblo turístico reconocido por sus calles empedradas, arquitectura colonial, arte, cultura y vista al lago Suchitlán.', NULL, 'Cuscatlán', NULL, 'Cuscatlán', 'Suchitoto', 13.9381000, -89.0278000, 'Centro histórico de Suchitoto', NULL, 'Información turística municipal', NULL, '2600-0103', NULL, 'img/destinos/suchitoto.jpg', 20.00, 'Todos los días', NULL, NULL, NULL, 'Abierto todos los días', NULL, 'Ideal para caminar, tomar fotografías y degustar comida típica.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(4, 6, 'Joya de Cerén', NULL, 'Sitio arqueológico declarado Patrimonio de la Humanidad, conocido como la Pompeya de América.', NULL, 'La Libertad', NULL, 'La Libertad', 'San Juan Opico', 13.8277000, -89.3603000, 'San Juan Opico, La Libertad', NULL, 'Administración del sitio arqueológico', NULL, '2600-0104', NULL, 'img/destinos/joya-de-ceren.jpg', 3.00, 'Todos los días', NULL, '07:00:00', '16:53:00', '9:00 a.m. - 4:00 p.m.', NULL, 'Consultar horarios actualizados antes de visitar.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(5, 2, 'Lago de Coatepeque', NULL, 'Lago de origen volcánico reconocido por sus aguas azuladas, restaurantes, miradores y actividades acuáticas.', NULL, 'Santa Ana', NULL, 'Santa Ana', 'El Congo / Coatepeque', 13.8643000, -89.5450000, 'Municipios de El Congo y Coatepeque', NULL, 'Información turística local', NULL, '2600-0105', NULL, 'img/destinos/coatepeque.jpg', 25.85, 'Todos los días', NULL, NULL, NULL, 'Abierto todos los días', NULL, 'Reservar con anticipación si se visitan restaurantes o alojamientos.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(6, 1, 'Playa El Cuco', NULL, 'Playa reconocida de la zona oriental de El Salvador, ideal para descanso, turismo familiar y gastronomía local.', NULL, 'Chirilagua, San Miguel', NULL, 'San Miguel', 'Chirilagua', 13.1739000, -88.1078000, 'Zona costera de Playa El Cuco, Chirilagua, San Miguel.', NULL, 'Información turística local', NULL, '2600-0001', NULL, 'img/elcuco_real.png', 15.00, 'Todos los días', NULL, '07:00:00', '18:00:00', NULL, NULL, 'Llevar protector solar, ropa cómoda y visitar durante la mañana.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(7, 2, 'Volcán Chaparrastique', NULL, 'Uno de los volcanes más representativos de la zona oriental, atractivo para visitantes interesados en naturaleza y paisajes.', NULL, 'San Miguel', NULL, 'San Miguel', 'San Miguel', 13.4347000, -88.2697000, 'Área del Volcán Chaparrastique, San Miguel.', NULL, 'Información turística municipal', NULL, '2600-0002', NULL, 'img/chaparrastique_real.png', 10.00, 'Todos los días', NULL, '06:00:00', '16:00:00', NULL, NULL, 'Usar calzado adecuado, llevar agua y verificar condiciones climáticas antes de visitar.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(8, 2, 'Laguna de Alegría', NULL, 'Destino natural ubicado en Usulután, conocido por sus paisajes, clima agradable y valor turístico.', NULL, 'Alegría, Usulután', NULL, 'Usulután', 'Alegría', 13.5069000, -88.4856000, 'Laguna de Alegría, municipio de Alegría, Usulután.', NULL, 'Información turística de Alegría', NULL, '2600-0003', NULL, 'img/alegria_real.png', 8.00, 'Todos los días', NULL, '07:00:00', '17:00:00', NULL, NULL, 'Ideal para fotografía, caminatas y turismo familiar.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(9, 1, 'Golfo de Fonseca', NULL, 'Zona costera compartida por El Salvador, Honduras y Nicaragua, reconocida por sus paisajes marítimos e islas.', NULL, 'La Unión', NULL, 'La Unión', 'La Unión', 13.3369000, -87.8439000, 'Zona costera del Golfo de Fonseca, La Unión.', NULL, 'Información turística local', NULL, '2600-0004', NULL, 'img/golfo_real.png', 20.00, 'Todos los días', NULL, '07:00:00', '17:00:00', NULL, NULL, 'Consultar disponibilidad de recorridos en lancha y llevar protección solar.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(10, 5, 'Centro Recreativo El Pacayal', NULL, 'Centro recreativo ideal para convivencias familiares, descanso y actividades al aire libre.', NULL, 'San Miguel', NULL, 'San Miguel', 'San Miguel', 13.4833000, -88.1833000, 'Zona de El Pacayal, San Miguel.', NULL, 'Administración del centro recreativo', NULL, '2600-0005', NULL, 'img/pacayal_real.png', 12.00, 'Sábado y domingo', NULL, '08:00:00', '17:00:00', NULL, NULL, 'Recomendado para visitas familiares y actividades recreativas.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(11, 3, 'Restaurante Mirador Oriental', NULL, 'Restaurante turístico con comida típica salvadoreña y ambiente familiar.', NULL, 'San Miguel', NULL, 'San Miguel', 'San Miguel', 13.4830000, -88.1750000, 'Carretera Panamericana, San Miguel.', NULL, 'Atención al cliente', NULL, '2600-0002', 'https://www.facebook.com/', 'img/pacayal_paisaje.png', 18.00, 'Martes a domingo', NULL, '10:00:00', '21:00:00', NULL, NULL, 'Ideal para almuerzos familiares y visitantes que buscan gastronomía local.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(12, 4, 'Hotel Vista Azul', NULL, 'Hotel turístico orientado a visitantes que buscan alojamiento cerca de la playa.', NULL, 'El Cuco, San Miguel', NULL, 'San Miguel', 'Chirilagua', 13.1760000, -88.1050000, 'Calle principal hacia Playa El Cuco, Chirilagua.', NULL, 'Recepción del hotel', NULL, '2600-0003', 'https://www.example.com', 'img/elcuco_real.png', 45.00, 'Todos los días', NULL, '00:00:00', '23:59:00', NULL, NULL, 'Recomendado para visitantes que desean hospedarse cerca de la playa.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09'),
(13, 6, 'Centro Histórico de Alegría', NULL, 'Zona cultural con arquitectura tradicional, gastronomía local y espacios para recorrer en familia.', NULL, 'Alegría, Usulután', NULL, 'Usulután', 'Alegría', 13.5000000, -88.4833000, 'Centro del municipio de Alegría, Usulután.', NULL, 'Casa de la cultura local', NULL, '2600-0008', NULL, 'img/alegria_real.png', 5.00, 'Todos los días', NULL, '08:00:00', '18:00:00', NULL, NULL, 'Visitar el parque central, probar comida local y recorrer los alrededores.', NULL, 1, '2026-06-01 06:50:09', '2026-06-01 06:50:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `destino_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_04_205227_create_categorias_table', 1),
(5, '2026_05_04_205237_create_destinos_table', 1),
(6, '2026_05_04_205243_create_favoritos_table', 1),
(7, '2026_05_04_205312_add_rol_to_users_table', 1),
(8, '2026_05_16_004032_add_horario_detallado_to_destinos_table', 1),
(9, '2026_05_17_171804_add_ubicacion_avanzada_to_destinos_table', 1),
(10, '2026_05_31_015217_add_contact_fields_to_destinos_table', 1),
(11, '2026_06_03_223417_add_english_columns_to_tables', 2),
(12, '2026_06_03_224027_add_more_english_columns_to_destinos', 2),
(13, '2026_06_03_230633_add_direccion_horario_en_to_destinos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'usuario',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador GeoTurismoSV', 'admin@geoturismosv.com', NULL, '$2y$12$KeP3cytTtj/UDD3FcmjbNO1eddB7lqaYVZDjfx/BSoG2t1ky6civi', 'admin', NULL, '2026-06-01 06:50:08', '2026-06-01 06:50:08'),
(2, 'Usuario Turista', 'usuario@geoturismosv.com', NULL, '$2y$12$DcSLIDgQjKXSAAscJ72NiOAb4S1IeVk3pVl3ThlLs86argglbG45C', 'usuario', NULL, '2026-06-01 06:50:09', '2026-06-01 06:50:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorias_nombre_unique` (`nombre`);

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinos_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favoritos_user_id_destino_id_unique` (`user_id`,`destino_id`),
  ADD KEY `favoritos_destino_id_foreign` (`destino_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `destinos`
--
ALTER TABLE `destinos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD CONSTRAINT `destinos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_destino_id_foreign` FOREIGN KEY (`destino_id`) REFERENCES `destinos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
