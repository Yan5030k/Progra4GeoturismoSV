<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nombre_en',
        'descripcion',
        'descripcion_en',
        'estado',
    ];

    /**
     * Boot the model to handle events.
     */
    protected static function booted()
    {
        static::saving(function ($categoria) {
            try {
                $tr = new GoogleTranslate('en', 'es');

                if ($categoria->isDirty('nombre') || (empty($categoria->nombre_en) && !empty($categoria->nombre))) {
                    $categoria->nombre_en = $tr->translate($categoria->nombre);
                }

                if ($categoria->isDirty('descripcion') || (empty($categoria->descripcion_en) && !empty($categoria->descripcion))) {
                    $categoria->descripcion_en = $tr->translate($categoria->descripcion);
                }
            } catch (\Exception $e) {
                Log::error('Error translating Categoria: ' . $e->getMessage());
            }
        });
    }

    /**
     * Una categoría puede tener muchos destinos.
     */
    public function destinos()
    {
        return $this->hasMany(Destino::class);
    }
}