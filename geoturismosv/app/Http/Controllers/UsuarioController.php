<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Favorito;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    /**
     * Muestra el panel principal del usuario registrado.
     */
    public function panel()
    {
        $favoritosRecientes = Favorito::with('destino.categoria')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        $totalFavoritos = Favorito::where('user_id', auth()->id())->count();
        $totalDestinos = Destino::where('estado', true)->count();

        return Inertia::render('Usuario/Panel', [
            'favoritosRecientes' => $favoritosRecientes,
            'totalFavoritos' => $totalFavoritos,
            'totalDestinos' => $totalDestinos,
        ]);
    }
}