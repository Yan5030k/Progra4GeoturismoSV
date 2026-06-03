<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'nombre_en',
        'descripcion',
        'descripcion_en',
        'ubicacion',
        'ubicacion_en',
        'departamento',
        'municipio',
        'direccion',
        'direccion_en',
        'contacto',
        'contacto_en',
        'telefono',
        'sitio_web',
        'costo_estimado',
        'dias_atencion',
        'dias_atencion_en',
        'hora_apertura',
        'hora_cierre',
        'horario',
        'horario_en',
        'recomendaciones',
        'recomendaciones_en',
        'imagen',
        'estado',
        'latitud',
        'longitud',
    ];

    /**
     * Boot the model to handle events.
     */
    protected static function booted()
    {
        static::saving(function ($destino) {
            try {
                $tr = new GoogleTranslate('en', 'es');

                $fieldsToTranslate = [
                    'nombre' => 'nombre_en',
                    'descripcion' => 'descripcion_en',
                    'ubicacion' => 'ubicacion_en',
                    'direccion' => 'direccion_en',
                    'recomendaciones' => 'recomendaciones_en',
                    'contacto' => 'contacto_en',
                    'dias_atencion' => 'dias_atencion_en',
                    'horario' => 'horario_en'
                ];

                foreach ($fieldsToTranslate as $esField => $enField) {
                    if (!empty($destino->{$esField}) && ($destino->isDirty($esField) || empty($destino->{$enField}))) {
                        $destino->{$enField} = $tr->translate((string) $destino->{$esField});
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error translating Destino: ' . $e->getMessage());
            }
        });
    }

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