<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    use HasFactory;

    protected $fillable = [
        'set_id',
        'accion_punto',
        'punto_actual',
        'jugador_id',
    ];

    public function set()
    {
        return $this->belongsTo(Set::class);
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}
