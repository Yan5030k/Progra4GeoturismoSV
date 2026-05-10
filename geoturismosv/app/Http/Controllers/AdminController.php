<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Destino;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Muestra el dashboard principal del administrador.
     */
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'totalUsuarios' => User::count(),
            'totalCategorias' => Categoria::count(),
            'totalDestinos' => Destino::count(),
            'destinosActivos' => Destino::where('estado', true)->count(),
        ]);
    }

    /**
     * Muestra los usuarios registrados.
     */
    public function usuarios()
    {
        $usuarios = User::latest()->get();

        return Inertia::render('Admin/Usuarios', [
            'usuarios' => $usuarios,
        ]);
    }
}