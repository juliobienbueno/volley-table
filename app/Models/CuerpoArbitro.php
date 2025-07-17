<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuerpoArbitro extends Model
{
    use HasFactory;

    protected $fillable = [
        'primer_arbitro',
        'segundo_arbitro',
        'juez_linea_1',
        'juez_linea_2',
        'juez_linea_3',
        'juez_linea_4',
        'planillero',
        'asistente_planilla',
    ];

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
