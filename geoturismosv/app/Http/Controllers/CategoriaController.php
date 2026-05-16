<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    /**
     * Lista todas las categorías registradas.
     */
    public function index()
    {
        $categorias = Categoria::latest()->get();

        return Inertia::render('Admin/Categorias/Index', [
            'categorias' => $categorias,
        ]);
    }

    /**
     * Muestra el formulario para crear una categoría.
     */
    public function create()
    {
        return Inertia::render('Admin/Categorias/Create');
    }

    /**
     * Guarda una nueva categoría.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'descripcion' => 'required|string|min:10',
            'estado' => 'required|boolean',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique' => 'Ya existe una categoría con ese nombre.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'estado.required' => 'Debe seleccionar un estado.',
        ]);

        Categoria::create($request->only([
            'nombre',
            'descripcion',
            'estado',
        ]));

        return redirect()
            ->route('admin.categorias.index', [], 303)
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una categoría.
     */
    public function edit(Categoria $categoria)
    {
        return Inertia::render('Admin/Categorias/Edit', [
            'categoria' => $categoria,
        ]);
    }

    /**
     * Actualiza una categoría existente.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'required|string|min:10',
            'estado' => 'required|boolean',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique' => 'Ya existe otra categoría con ese nombre.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'estado.required' => 'Debe seleccionar un estado.',
        ]);

        $categoria->update($request->only([
            'nombre',
            'descripcion',
            'estado',
        ]));

        return redirect()
            ->route('admin.categorias.index', [], 303)
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Elimina una categoría.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()
            ->route('admin.categorias.index', [], 303)
            ->with('success', 'Categoría eliminada correctamente.');
    }
}