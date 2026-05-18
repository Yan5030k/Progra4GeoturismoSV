# GeoTurismoSV

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

Funciones implementadas en este avance
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

Estado del README

Este README es una versión básica para el segundo avance del proyecto.
La documentación final será ampliada posteriormente con más detalles técnicos, capturas, estructura completa del sistema y explicación de instalación más detallada.
