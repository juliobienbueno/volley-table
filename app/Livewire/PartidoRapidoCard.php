<?php

namespace App\Livewire;

use Livewire\Component;

class PartidoRapidoCard extends Component
{
    public $isModalOpen = false;
    public $tabActual = 'partido';

    public $form = [];

    public function mount()
    {
        $this->resetForm();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function marcarCapitan($jugadoresKey, $index)
    {
        if (!isset($this->form[$jugadoresKey])) return;

        foreach ($this->form[$jugadoresKey] as $i => &$jugador) {
            $jugador['capitan'] = ($i === $index);
        }

        $this->form[$jugadoresKey] = $this->form[$jugadoresKey]; // Forzar actualización
    }

    public function guardarPartido()
    {
        // Guardar datos o emitir evento según tu necesidad

        $this->resetModal();
    }

    public function resetModal()
    {
        $this->isModalOpen = false;
        $this->tabActual = 'partido';
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->form = [
            'lugar' => '',
            'cancha' => '',
            'equipoA' => '',
            'equipoB' => '',
            'entrenadorA' => '',
            'asistenteA' => '',
            'entrenadorB' => '',
            'asistenteB' => '',
            'jugadoresA' => array_fill(0, 16, [
                'nombre' => '', 'numero' => '', 'posicion' => '', 'capitan' => false
            ]),
            'jugadoresB' => array_fill(0, 16, [
                'nombre' => '', 'numero' => '', 'posicion' => '', 'capitan' => false
            ]),
            'arbitros' => ['', ''],
            'juecesLinea' => ['', '', '', ''],
            'mesa' => ['marcador' => '', 'asistente' => ''],
        ];
    }

    public function render()
    {
    $posiciones = ['Armador', 'Opuesto', 'Central', 'Libero', 'Punta'];
    return view('livewire.partido-rapido-card', compact('posiciones'));
    }

}
