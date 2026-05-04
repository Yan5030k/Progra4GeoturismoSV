<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destino_id',
    ];

    /**
     * Un favorito pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un favorito pertenece a un destino turístico.
     */
    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }
}