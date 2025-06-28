<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class PartidoEnJuego extends Component
{
    public $form;

    public $puntosA = 0;
    public $puntosB = 0;
    public $setA = 0;
    public $setB = 0;

    public $tiemposA = 2;
    public $tiemposB = 2;
    public $cambiosA = 6;
    public $cambiosB = 6;

    public function mount()
    {
        $this->form = Session::get('partido_config');
    }

    public function render()
    {
        return view('livewire.partido-en-juego');
    }

    public function sumarPunto($equipo)
    {
        $this->{"puntos$equipo"}++;
    }

    public function restarPunto($equipo)
    {
        if ($this->{"puntos$equipo"} > 0) {
            $this->{"puntos$equipo"}--;
        }
    }

    public function usarTiempo($equipo)
    {
        if ($this->{"tiempos$equipo"} > 0) {
            $this->{"tiempos$equipo"}--;
        }
    }

    public function usarCambio($equipo)
    {
        if ($this->{"cambios$equipo"} > 0) {
            $this->{"cambios$equipo"}--;
        }
    }
}
