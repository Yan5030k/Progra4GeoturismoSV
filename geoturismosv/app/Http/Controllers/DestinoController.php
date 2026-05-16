<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Destino;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DestinoController extends Controller
{
    /**
     * Lista todos los destinos turísticos registrados.
     */
    public function index()
    {
        $destinos = Destino::with('categoria')
            ->latest()
            ->get();

        return Inertia::render('Admin/Destinos/Index', [
            'destinos' => $destinos,
        ]);
    }

    /**
     * Muestra el formulario para crear un destino.
     */
    public function create()
    {
        $categorias = Categoria::where('estado', true)->get();

        return Inertia::render('Admin/Destinos/Create', [
            'categorias' => $categorias,
        ]);
    }

    /**
     * Guarda un nuevo destino turístico.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'required|string|min:20',
            'ubicacion' => 'required|string|max:150',
            'direccion' => 'nullable|string|max:255',
            'imagen' => 'nullable|string|max:255',
            'costo_estimado' => 'required|numeric|min:0',
            'dias_atencion' => 'required|string',
            'hora_apertura' => 'required',
            'hora_cierre' => 'required',
            'recomendaciones' => 'nullable|string',
            'estado' => 'required|boolean',
        ], [
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'nombre.required' => 'El nombre del destino es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 20 caracteres.',
            'ubicacion.required' => 'La ubicación es obligatoria.',
            'costo_estimado.required' => 'El costo estimado es obligatorio.',
            'costo_estimado.numeric' => 'El costo estimado debe ser un número.',
            'estado.required' => 'Debe seleccionar un estado.',
            'dias_atencion.required' => 'Debe seleccionar los días de atención.',
            'hora_apertura.required' => 'Debe ingresar la hora de apertura.',
            'hora_cierre.required' => 'Debe ingresar la hora de cierre.',
        ]);

        Destino::create($request->only([
            'categoria_id',
            'nombre',
            'descripcion',
            'ubicacion',
            'direccion',
            'imagen',
            'costo_estimado',
            'dias_atencion',
            'hora_apertura',
            'hora_cierre',
            'recomendaciones',
            'estado',
        ]));

        return redirect()
            ->route('admin.destinos.index', [], 303)
            ->with('success', 'Destino turístico creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un destino.
     */
    public function edit(Destino $destino)
    {
        $categorias = Categoria::where('estado', true)->get();

        return Inertia::render('Admin/Destinos/Edit', [
            'destino' => $destino,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Actualiza un destino turístico existente.
     */
    public function update(Request $request, Destino $destino)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'required|string|min:20',
            'ubicacion' => 'required|string|max:150',
            'direccion' => 'nullable|string|max:255',
            'imagen' => 'nullable|string|max:255',
            'costo_estimado' => 'required|numeric|min:0',
            'dias_atencion' => 'required|string',
            'hora_apertura' => 'required',
            'hora_cierre' => 'required',
            'recomendaciones' => 'nullable|string',
            'estado' => 'required|boolean',
        ], [
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'nombre.required' => 'El nombre del destino es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 20 caracteres.',
            'ubicacion.required' => 'La ubicación es obligatoria.',
            'costo_estimado.required' => 'El costo estimado es obligatorio.',
            'costo_estimado.numeric' => 'El costo estimado debe ser un número.',
            'estado.required' => 'Debe seleccionar un estado.',
            'dias_atencion.required' => 'Debe seleccionar los días de atención.',
            'hora_apertura.required' => 'Debe ingresar la hora de apertura.',
            'hora_cierre.required' => 'Debe ingresar la hora de cierre.',
        ]);

        $destino->update($request->only([
            'categoria_id',
            'nombre',
            'descripcion',
            'ubicacion',
            'direccion',
            'imagen',
            'costo_estimado',
            'dias_atencion',
            'hora_apertura',
            'hora_cierre',
            'recomendaciones',
            'estado',
        ]));

        return redirect()
            ->route('admin.destinos.index', [], 303)
            ->with('success', 'Destino turístico actualizado correctamente.');
    }

    /**
     * Elimina un destino turístico.
     */
    public function destroy(Destino $destino)
    {
        $destino->delete();

        return redirect()
            ->route('admin.destinos.index', [], 303)
            ->with('success', 'Destino turístico eliminado correctamente.');
    }
}