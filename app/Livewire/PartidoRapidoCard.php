<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class PartidoRapidoCard extends Component
{
    public $isModalOpen = false;
    public $tabActual = 'partido';
    public $form = [];
    public $posiciones = ['Armador', 'Opuesto', 'Central', 'Libero', 'Punta'];

    public function mount()
    {
        $this->resetForm();
        $this->cargarDatosGuardados(); // Cargar desde localStorage si existe
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function guardarPartido()
    {
        $this->validate([
            'form.equipoA' => 'required|string|min:3',
            'form.equipoB' => 'required|string|min:3',
            'form.jugadoresA.*.numero' => 'nullable|numeric|min:1|max:99',
            'form.jugadoresB.*.numero' => 'nullable|numeric|min:1|max:99',
        ]);

        // Guardar en sesión
        Session::put('partido_config', $this->form);

        // Emitir evento para Alpine.js/localStorage
        $this->dispatch('datosGuardados', datos: $this->form);

        // Cerrar modal y resetear
        $this->resetModal();

        // Redirigir o emitir evento según tu flujo
        return redirect()->route('partido-real');
    }

    private function cargarDatosGuardados()
    {
        if ($datos = Session::get('partido_config')) {
            $this->form = $datos;
        }
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
            'equipoA' => 'Equipo Local',
            'equipoB' => 'Equipo Visitante',
            'entrenadorA' => '',
            'asistenteA' => '',
            'entrenadorB' => '',
            'asistenteB' => '',
            'jugadoresA' => array_map(fn() => [
                'nombre' => '',
                'numero' => '',
                'posicion' => '',
            ], range(0, 13)),
            'jugadoresB' => array_map(fn() => [
                'nombre' => '',
                'numero' => '',
                'posicion' => '',
            ], range(0, 13)),
            'arbitros' => ['', ''],
            'juecesLinea' => ['', '', '', ''],
            'mesa' => ['marcador' => '', 'asistente' => ''],
        ];
    }

    public function render()
    {
        return view('livewire.partido-rapido-card');
    }
}
