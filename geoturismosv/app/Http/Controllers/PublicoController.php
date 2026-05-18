<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Destino;
use App\Models\Favorito;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicoController extends Controller
{
    /**
     * Muestra la página principal pública.
     */
    public function inicio()
    {
        $destinos = Destino::with('categoria')
            ->where('estado', true)
            ->latest()
            ->take(3)
            ->get();

        return Inertia::render('Publico/Inicio', [
            'destinos' => $destinos,
        ]);
    }

    /**
     * Muestra todos los destinos turísticos disponibles.
     */
    public function destinos()
    {
        $destinos = Destino::with('categoria')
            ->where('estado', true)
            ->latest()
            ->get();

        $categorias = Categoria::where('estado', true)->get();

        return Inertia::render('Publico/Destinos', [
            'destinos' => $destinos,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Muestra el detalle de un destino turístico.
     */
    public function detalleDestino(Destino $destino)
    {
        $destino->load('categoria');

        $esFavorito = false;

        if (auth()->check()) {
            $esFavorito = Favorito::where('user_id', auth()->id())
                ->where('destino_id', $destino->id)
                ->exists();
        }

        return Inertia::render('Publico/DetalleDestino', [
            'destino' => $destino,
            'esFavorito' => $esFavorito,
            'usuarioLogueado' => auth()->check(),
        ]);
    }

    /**
     * Muestra las categorías públicas.
     */
    public function categorias()
    {
        $categorias = Categoria::withCount('destinos')
            ->where('estado', true)
            ->get();

        return Inertia::render('Publico/Categorias', [
            'categorias' => $categorias,
        ]);
    }

    /**
     * Muestra la página informativa de la empresa.
     */
    public function sobreNosotros()
    {
        return Inertia::render('Publico/SobreNosotros');
    }
}