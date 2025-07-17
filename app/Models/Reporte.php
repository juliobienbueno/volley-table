<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'datos',
        'usuario_id',
        'partido_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }
}

