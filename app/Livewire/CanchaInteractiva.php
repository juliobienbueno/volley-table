<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CanchaInteractiva extends Component
{
    public $equipoLocal = [];
    public $equipoVisita = [];

    public $jugadoresLocalTitulares = [];
    public $jugadoresVisitaTitulares = [];

    public $asignacionTitularesLocal = [null, null, null, null, null, null];
    public $asignacionTitularesVisita = [null, null, null, null, null, null];

    public $modoSeleccionTitulares = false;

    protected $listeners = [
        'cargarTitularesDesdeJS',
    ];

    public function mount()
    {
        $datos = Session::get('partido_config');

        if (!$datos) {
            abort(403, 'No hay datos de partido configurados.');
        }

        $this->equipoLocal = [
            'nombre' => $datos['equipoA'],
            'jugadores' => $datos['jugadoresA'],
            'entrenador' => $datos['entrenadorA'],
            'asistente' => $datos['asistenteA'],
        ];

        $this->equipoVisita = [
            'nombre' => $datos['equipoB'],
            'jugadores' => $datos['jugadoresB'],
            'entrenador' => $datos['entrenadorB'],
            'asistente' => $datos['asistenteB'],
        ];

        // NO seteamos titulares aquí porque los cargaremos desde localStorage vía JS
        $this->jugadoresLocalTitulares = [];
        $this->jugadoresVisitaTitulares = [];
    }

    public function render()
    {
        return view('livewire.cancha-interactiva');
    }

    public function seleccionarTitulares()
    {
        $this->modoSeleccionTitulares = true;
    }

    public function confirmarTitulares()
    {
        if (in_array(null, $this->asignacionTitularesLocal, true) || in_array(null, $this->asignacionTitularesVisita, true)) {
            $this->dispatch('alerta', ['mensaje' => 'Debes seleccionar los 6 titulares de ambos equipos.']);
            return;
        }

        if (count(array_unique($this->asignacionTitularesLocal)) < count($this->asignacionTitularesLocal)) {
            $this->dispatch('alerta', ['mensaje' => 'Hay jugadores duplicados en el equipo Local.']);
            return;
        }

        if (count(array_unique($this->asignacionTitularesVisita)) < count($this->asignacionTitularesVisita)) {
            $this->dispatch('alerta', ['mensaje' => 'Hay jugadores duplicados en el equipo Visita.']);
            return;
        }

        // Posiciones romanas
        $posLabels = ['Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', 'Ⅵ'];

        $this->jugadoresLocalTitulares = collect($this->asignacionTitularesLocal)
            ->map(function ($idx, $pos) use ($posLabels) {
                if (!is_null($idx) && isset($this->equipoLocal['jugadores'][$idx])) {
                    $jugador = $this->equipoLocal['jugadores'][$idx];
                    return [
                        'numero' => $jugador['numero'],
                        'nombre' => $jugador['nombre'],
                        'posicion' => $posLabels[$pos],
                    ];
                }
                return null;
            })->filter()->values()->toArray();

        $this->jugadoresVisitaTitulares = collect($this->asignacionTitularesVisita)
            ->map(function ($idx, $pos) use ($posLabels) {
                if (!is_null($idx) && isset($this->equipoVisita['jugadores'][$idx])) {
                    $jugador = $this->equipoVisita['jugadores'][$idx];
                    return [
                        'numero' => $jugador['numero'],
                        'nombre' => $jugador['nombre'],
                        'posicion' => $posLabels[$pos],
                    ];
                }
                return null;
            })->filter()->values()->toArray();

        $this->modoSeleccionTitulares = false;

        $this->dispatch('titulares-guardados', [
            'local' => $this->jugadoresLocalTitulares,
            'visita' => $this->jugadoresVisitaTitulares,
        ]);
    }
}
