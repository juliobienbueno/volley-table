<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $fillable = ['partido_id', 'numero_set'];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function puntos()
    {
        return $this->hasMany(Punto::class);
    }
}
