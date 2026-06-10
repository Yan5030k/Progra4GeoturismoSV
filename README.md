# GeoTurismoSV

GeoTurismoSV es una plataforma web dedicada a promover los destinos turísticos y atractivos naturales de El Salvador. Permite a los usuarios explorar, conocer y obtener información relevante sobre diversos lugares turísticos del país.

## Integrantes del Grupo

- Marielena Velasques Escobar - SMSS018024
- Alejandra María Baires Campos - SMSS038924
- Brayan Isaac Carranza Amaya - SMSS023824
- Ariel Esau Yanes Quintanilla - SMSS008924
- Jhoan Mauricio Ortega Ventura - SMSS003224

## Módulos del Sistema

El sistema está dividido en 3 módulos principales según el nivel de acceso:

### 1. Módulo Público (Sin iniciar sesión)
Cualquier persona que visite la plataforma puede:
- Navegar por la página de inicio para conocer sobre el proyecto.
- Explorar el catálogo público de destinos turísticos.
- Ver los detalles de cada destino (descripción, ubicación, horarios, precios e imágenes).
- Filtrar destinos por categorías.
- Conocer más sobre el equipo en la página de "Sobre Nosotros".

### 2. Módulo de Usuario (Sesión iniciada)
Los usuarios que se registran e inician sesión en la plataforma tienen acceso a las funciones públicas y además pueden:
- Acceder a un panel de control personal.
- Agregar destinos turísticos a su lista de favoritos para tenerlos guardados.
- Ver, administrar y eliminar los destinos de su lista de favoritos.
- Navegar la plataforma de forma personalizada.

### 3. Módulo de Administrador
El administrador tiene control total sobre el contenido de la plataforma. Desde su panel administrativo exclusivo puede:
- **Gestión de Categorías:** Crear, leer, actualizar y eliminar (CRUD) categorías de turismo.
- **Gestión de Destinos:** Crear, editar y eliminar destinos turísticos, estableciendo sus descripciones, ubicaciones detalladas, horarios de atención y costos.
- **Gestión de Imágenes:** Subir y administrar las fotografías asociadas a cada destino turístico.
- **Gestión de Usuarios:** Visualizar el listado de usuarios registrados en el sistema.

## Credenciales de prueba

### Administrador

Correo: admin@geoturismosv.com  
Contraseña: 12345678  

El administrador puede acceder al panel administrativo, gestionar categorías, gestionar destinos turísticos, subir imágenes, editar información y visualizar usuarios registrados.

### Usuario normal

Correo: usuario@geoturismosv.com  
Contraseña: 12345678  

El usuario puede navegar por los destinos turísticos, consultar detalles, guardar destinos en favoritos, ver su panel y administrar su lista de favoritos.

---

## Comandos para ejecutar el proyecto

### 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
2. Entrar a la carpeta del proyecto
cd geoturismosv
3. Instalar dependencias de Laravel
composer install
4. Instalar dependencias de Node.js
npm install
5. Crear el archivo de configuración
cp .env.example .env

En Windows, si el comando anterior no funciona, crear manualmente una copia del archivo .env.example y renombrarla como .env.

6. Generar la clave de Laravel
php artisan key:generate
7. Configurar la base de datos en el archivo .env

Crear una base de datos en MySQL llamada:

geoturismosv

Luego configurar el archivo .env con los datos correspondientes. Ejemplo utilizado en el desarrollo:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8805
DB_DATABASE=geoturismosv
DB_USERNAME=root
DB_PASSWORD=

Nota: si MySQL utiliza el puerto por defecto, cambiar:

DB_PORT=8805

por:

DB_PORT=3306
8. Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

Este comando crea las tablas de la base de datos y carga datos iniciales, incluyendo usuarios de prueba, categorías y destinos turísticos.

9. Crear enlace de almacenamiento para imágenes
php artisan storage:link

Este comando permite mostrar las imágenes subidas desde el panel administrativo.

10. Limpiar caché de Laravel, si es necesario
php artisan optimize:clear
11. Levantar el servidor de Laravel

En una terminal ejecutar:

php artisan serve

El sistema estará disponible en:

http://127.0.0.1:8000
12. Levantar el frontend con Vite

En otra terminal ejecutar:

npm run dev
Ejecución recomendada

Usar dos terminales abiertas al mismo tiempo:

Terminal 1:

php artisan serve

Terminal 2:

npm run dev
Información resumida del proyecto

GeoTurismoSV es una plataforma web turística enfocada en centralizar información sobre destinos turísticos de El Salvador.

El objetivo del proyecto es facilitar que turistas nacionales, turistas extranjeros y personas interesadas en conocer el país puedan consultar destinos organizados por categorías, ubicación, horarios, costos estimados, recomendaciones e imágenes.

El sistema cuenta con dos tipos de usuarios principales:

Administrador
Usuario normal

El administrador puede gestionar la información del sistema desde un panel administrativo. Actualmente puede administrar categorías, destinos turísticos, imágenes, horarios, ubicación y usuarios registrados.

El usuario normal puede navegar por la plataforma, consultar destinos turísticos, ver información detallada y guardar destinos en su lista de favoritos.

Funciones principales del sistema
Página de inicio.
Página pública de destinos.
Página de detalle de destino.
Página pública de categorías.
Página Sobre Nosotros.
Registro e inicio de sesión.
Diferenciación de roles entre administrador y usuario.
Panel administrativo.
Panel de usuario.
CRUD completo de categorías.
CRUD completo de destinos turísticos.
Subida de imágenes para destinos.
Horario detallado por días de atención, hora de apertura y hora de cierre.
Campos de ubicación avanzada: departamento, municipio, latitud y longitud.
Guardar destinos como favoritos.
Ver listado de favoritos.
Eliminar destinos de favoritos.
Navegación dinámica según la sesión iniciada.
Tecnologías utilizadas
Laravel 12
Vue.js
Inertia.js
MySQL
Tailwind CSS
Laravel Breeze
Composer
Node.js
NPM
Git y GitHub
Tablas principales de la base de datos

Las tablas principales del sistema son:

users
categorias
destinos
favoritos

También existen tablas internas generadas por Laravel, como:

migrations
sessions
cache
jobs
failed_jobs
password_reset_tokens

Estas tablas forman parte del funcionamiento técnico del framework.

Estado del Proyecto

Esta es la entrega final del proyecto GeoTurismoSV, la cual cuenta con todas las funcionalidades completadas para su evaluación.
