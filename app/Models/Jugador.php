<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'nombre',
        'numero',
        'posicion',
        'es_capitan',
        'es_libero',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}

