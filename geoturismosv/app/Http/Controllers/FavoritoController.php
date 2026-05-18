<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Destino;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoritoController extends Controller
{
    /**
     * Muestra los destinos favoritos del usuario autenticado.
     */
    public function index()
    {
        $favoritos = Favorito::with('destino.categoria')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Favoritos/Index', [
            'favoritos' => $favoritos,
        ]);
    }

    /**
     * Guarda un destino como favorito del usuario autenticado.
     */
    public function store(Destino $destino)
    {
        Favorito::firstOrCreate([
            'user_id' => auth()->id(),
            'destino_id' => $destino->id,
        ]);

        return back(303)->with('success', 'Destino agregado a favoritos.');
    }

    /**
     * Elimina un destino de favoritos del usuario autenticado.
     */
    public function destroy(Destino $destino)
    {
        Favorito::where('user_id', auth()->id())
            ->where('destino_id', $destino->id)
            ->delete();

        return back(303)->with('success', 'Destino eliminado de favoritos.');
    }
}