<?php

namespace App\Livewire;

use Livewire\Component;

class TableroPuntaje extends Component
{
    public $puntosLocal = 0;
    public $puntosVisita = 0;

    public $tiemposLocal = 0;
    public $tiemposVisita = 0;

    public $cambiosLocal = 0;
    public $cambiosVisita = 0;

    public $saque = 'local';

    protected $listeners = [
        'resetearTablero' => 'resetear'
    ];

    public function sumarPunto($equipo)
    {
        if ($equipo === 'local') {
            $this->puntosLocal++;
            if ($this->saque !== 'local') {
                $this->saque = 'local';
                $this->dispatch('rotar', 'local');
            }
        } else {
            $this->puntosVisita++;
            if ($this->saque !== 'visita') {
                $this->saque = 'visita';
                $this->dispatch('rotar', 'visita');
            }
        }

        $this->dispatch('puntosActualizados', [
            'local' => $this->puntosLocal,
            'visita' => $this->puntosVisita,
            'saque' => $this->saque
        ]);
    }

    public function pedirTiempo($equipo)
    {
        if ($equipo === 'local' && $this->tiemposLocal < 2) {
            $this->tiemposLocal++;
        } elseif ($equipo === 'visita' && $this->tiemposVisita < 2) {
            $this->tiemposVisita++;
        }
    }

    public function pedirCambio($equipo)
    {
        if ($equipo === 'local' && $this->cambiosLocal < 6) {
            $this->cambiosLocal++;
            // Emitir evento para abrir modal en CanchaInteractiva
            $this->emit('abrirModalCambio', $equipo);
        } elseif ($equipo === 'visita' && $this->cambiosVisita < 6) {
            $this->cambiosVisita++;
            $this->emit('abrirModalCambio', $equipo);
        } else {
            // Opcional: mandar alerta que ya no se pueden hacer más cambios
            $this->emit('alerta', ['mensaje' => 'Límite máximo de cambios alcanzado.']);
        }
    }



    public function resetear()
    {
        $this->puntosLocal = 0;
        $this->puntosVisita = 0;
        $this->tiemposLocal = 0;
        $this->tiemposVisita = 0;
        $this->cambiosLocal = 0;
        $this->cambiosVisita = 0;
        $this->saque = 'local';
    }

    public function render()
    {
        return view('livewire.tablero-puntaje');
    }
}
