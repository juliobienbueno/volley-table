<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'equipo_local_id',
        'equipo_visita_id',
        'cancha_id',
        'cuerpo_arbitros_id',
        'horario_inicio',
        'horario_termino',
        'cantidad_sets',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function equipoVisita()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visita_id');
    }

    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }

    public function cuerpoArbitro()
    {
        return $this->belongsTo(CuerpoArbitro::class, 'cuerpo_arbitros_id');
    }

    public function sets()
    {
        return $this->hasMany(Set::class);
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }
}
