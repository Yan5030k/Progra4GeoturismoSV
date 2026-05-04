<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Crea usuarios iniciales para pruebas del sistema.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@geoturismosv.com'],
            [
                'name' => 'Administrador GeoTurismoSV',
                'password' => Hash::make('12345678'),
                'rol' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'usuario@geoturismosv.com'],
            [
                'name' => 'Usuario Turista',
                'password' => Hash::make('12345678'),
                'rol' => 'usuario',
            ]
        );
    }
}