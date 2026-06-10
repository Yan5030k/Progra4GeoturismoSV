# GeoturismoSV

GeoturismoSV es una plataforma web dedicada a promover los destinos turísticos y atractivos naturales de El Salvador. Permite a los usuarios explorar, conocer y obtener información relevante sobre diversos lugares turísticos del país.

## Integrantes del Grupo

- Marielena Velasques Escobar - SMSS018024
- Alejandra María Baires Campos - SMSS038924
- Brayan Isaac Carranza Amaya - SMSS023824
- Ariel Esau Yanes Quintanilla - SMSS008924
- Jhoan Mauricio Ortega Ventura - SMSS003224

## Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js y npm
- MySQL (Gestor de Base de Datos utilizado)

## Instalación

Siga estos pasos para configurar el proyecto en su entorno de desarrollo local:

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd geoturismosv
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**
   ```bash
   npm install
   ```

4. **Configurar el entorno**
   Copie el archivo de ejemplo `.env.example` a `.env` y configure las credenciales de su base de datos.
   ```bash
   cp .env.example .env
   ```
   Asegúrese de configurar la conexión a **MySQL** en su archivo `.env` según su entorno local:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3307
   DB_DATABASE=geoturismosv
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generar la clave de la aplicación**
   ```bash
   php artisan key:generate
   ```

6. **Ejecutar las migraciones y seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Compilar los assets del frontend**
   ```bash
   npm run build
   # o para desarrollo en vivo:
   # npm run dev
   ```

8. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

El proyecto estará disponible en `http://localhost:8000`.

## Credenciales de Acceso (Administrador)

Para acceder al panel de administración, utilice las siguientes credenciales:

- **Correo electrónico:** admin@geoturismosv.com
- **Contraseña:** 12345678

## Base de Datos

El gestor de base de datos utilizado para este proyecto es **MySQL**.
