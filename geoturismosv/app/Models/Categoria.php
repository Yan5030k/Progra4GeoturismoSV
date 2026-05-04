<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Una categoría puede tener muchos destinos.
     */
    public function destinos()
    {
        return $this->hasMany(Destino::class);
    }
}