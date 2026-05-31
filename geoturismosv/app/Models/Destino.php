<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'ubicacion',
        'departamento',
        'municipio',
        'direccion',
        'contacto',
        'telefono',
        'sitio_web',
        'costo_estimado',
        'dias_atencion',
        'hora_apertura',
        'hora_cierre',
        'recomendaciones',
        'imagen',
        'estado',
        'latitud',
        'longitud',
    ];

    /**
     * Un destino pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Un destino puede aparecer en muchos favoritos.
     */
    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }
}