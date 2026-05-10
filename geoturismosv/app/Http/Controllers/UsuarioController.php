<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    /**
     * Muestra el panel principal del usuario registrado.
     */
    public function panel()
    {
        $favoritos = Favorito::with('destino.categoria')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Usuario/Panel', [
            'favoritos' => $favoritos,
        ]);
    }
}