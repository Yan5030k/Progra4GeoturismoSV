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
    public function destinos(Request $request)
{
    $query = Destino::with('categoria')->where('estado', true);

    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->where(function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
              ->orWhere('ubicacion', 'like', "%{$search}%")
              ->orWhere('descripcion', 'like', "%{$search}%")
              ->orWhere('departamento', 'like', "%{$search}%")
              ->orWhere('municipio', 'like', "%{$search}%");
        });
    }

    if ($request->filled('categoria_id')) {
        $query->where('categoria_id', $request->input('categoria_id'));
    }

    if ($request->filled('departamento')) {
        $query->where('departamento', $request->input('departamento'));
    }

    if ($request->filled('municipio')) {
        $query->where('municipio', 'like', '%' . $request->input('municipio') . '%');
    }

    if ($request->filled('costo_min')) {
        $query->where('costo_estimado', '>=', $request->input('costo_min'));
    }

    if ($request->filled('costo_max')) {
        $query->where('costo_estimado', '<=', $request->input('costo_max'));
    }

    $destinos = $query->latest()->get();

    $categorias = Categoria::where('estado', true)
        ->orderBy('nombre')
        ->get();

    $departamentos = Destino::where('estado', true)
        ->whereNotNull('departamento')
        ->select('departamento')
        ->distinct()
        ->orderBy('departamento')
        ->pluck('departamento');

    return Inertia::render('Publico/Destinos', [
        'destinos' => $destinos,
        'categorias' => $categorias,
        'departamentos' => $departamentos,
        'filtros' => $request->only([
            'search',
            'categoria_id',
            'departamento',
            'municipio',
            'costo_min',
            'costo_max',
        ]),
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