<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'lugar'];

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
