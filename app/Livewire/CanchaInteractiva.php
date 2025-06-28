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

    // Rotaciones y puntaje
    public $rotacionLocal = [];
    public $rotacionVisita = [];

    public $puntosLocal = 0;
    public $puntosVisita = 0;

    public $saque = 'local';
    public $saqueAnterior = null;

    // Modal de cambio
    public $modalCambioVisible = false;
    public $equipoCambioActual = null; // 'local' o 'visita'
    public $jugadorASacarIndex = null; // índice del jugador titular a sacar
    public $jugadorAEntrarIndex = null; // índice del suplente que entrará

    // Registro de cambios para contar
    public $cambiosRealizadosLocal = [];
    public $cambiosRealizadosVisita = [];

    public $contadorCambiosLocal = 0;
    public $contadorCambiosVisita = 0;

    public $maxCambios = 6;

    protected $listeners = [
        'cargarTitularesDesdeJS',
        'puntosActualizados' => 'manejarRotacion',
        'abrirModalCambio' => 'abrirModalCambio',
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

        $this->jugadoresLocalTitulares = $this->mapearJugadores($this->asignacionTitularesLocal, $this->equipoLocal['jugadores']);
        $this->jugadoresVisitaTitulares = $this->mapearJugadores($this->asignacionTitularesVisita, $this->equipoVisita['jugadores']);

        $this->rotacionLocal = $this->jugadoresLocalTitulares;
        $this->rotacionVisita = $this->jugadoresVisitaTitulares;

        $this->modoSeleccionTitulares = false;

        $this->dispatch('titulares-guardados', [
            'local' => $this->jugadoresLocalTitulares,
            'visita' => $this->jugadoresVisitaTitulares,
        ]);
    }

    public function cargarTitularesDesdeJS($data)
    {
        $this->jugadoresLocalTitulares = $data['local'] ?? [];
        $this->jugadoresVisitaTitulares = $data['visita'] ?? [];

        $this->rotacionLocal = $this->jugadoresLocalTitulares;
        $this->rotacionVisita = $this->jugadoresVisitaTitulares;
    }

    public function manejarRotacion($datos)
    {
        $this->puntosLocal = $datos['local'];
        $this->puntosVisita = $datos['visita'];
        $nuevoSaque = $datos['saque'];

        // Actualizamos el estado del saque actual
        $this->saque = $nuevoSaque;

        if ($this->saqueAnterior === null) {
            $this->saqueAnterior = $nuevoSaque;
            return;
        }

        if ($nuevoSaque !== $this->saqueAnterior) {
            $this->rotar($nuevoSaque);
        }

        $this->saqueAnterior = $nuevoSaque;
    }


    public function rotar($equipo)
    {
        if ($equipo === 'local') {
            array_push($this->rotacionLocal, array_shift($this->rotacionLocal));
        } elseif ($equipo === 'visita') {
            array_push($this->rotacionVisita, array_shift($this->rotacionVisita));
        }

        // Actualizar posiciones romanas
        $posLabels = ['Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', 'Ⅵ'];
        foreach ($this->rotacionLocal as $i => &$jugador) {
            $jugador['posicion'] = $posLabels[$i] ?? $jugador['posicion'];
        }
        foreach ($this->rotacionVisita as $i => &$jugador) {
            $jugador['posicion'] = $posLabels[$i] ?? $jugador['posicion'];
        }

        $this->jugadoresLocalTitulares = $this->rotacionLocal;
        $this->jugadoresVisitaTitulares = $this->rotacionVisita;

        $this->dispatch('titulares-guardados', [
            'local' => $this->jugadoresLocalTitulares,
            'visita' => $this->jugadoresVisitaTitulares,
        ]);
    }


    private function mapearJugadores($asignacion, $jugadores)
    {
        $posLabels = ['Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', 'Ⅵ'];

        return collect($asignacion)
            ->map(function ($idx, $pos) use ($jugadores, $posLabels) {
                if (!is_null($idx) && isset($jugadores[$idx])) {
                    $jugador = $jugadores[$idx];
                    return [
                        'numero' => $jugador['numero'],
                        'nombre' => $jugador['nombre'],
                        'posicion' => $posLabels[$pos],
                    ];
                }
                return null;
            })->filter()->values()->toArray();
    }

    public function cambiarSaque()
    {
        $this->saque = $this->saque === 'local' ? 'visita' : 'local';
    }

    // Abrir modal para cambio
    public function abrirModalCambio($equipo)
    {
        $this->equipoCambioActual = $equipo;
        $this->modalCambioVisible = true;

        // Limpiar selecciones previas
        $this->jugadorASacarIndex = null;
        $this->jugadorAEntrarIndex = null;
    }

    // Confirmar cambio de jugador
    public function confirmarCambio()
    {
        if (is_null($this->jugadorASacarIndex) || is_null($this->jugadorAEntrarIndex)) {
            $this->dispatch('alerta', ['mensaje' => 'Debes seleccionar un titular y un suplente.']);
            return;
        }

        $cambiosRealizados = $this->equipoCambioActual === 'local' ? $this->cambiosRealizadosLocal : $this->cambiosRealizadosVisita;
        if (count($cambiosRealizados) >= $this->maxCambios) {
            $this->dispatch('alerta', ['mensaje' => 'Has alcanzado el límite máximo de cambios.']);
            $this->modalCambioVisible = false;
            return;
        }

        $titulares = $this->equipoCambioActual === 'local' ? $this->jugadoresLocalTitulares : $this->jugadoresVisitaTitulares;
        $equipo = $this->equipoCambioActual === 'local' ? $this->equipoLocal : $this->equipoVisita;
        if ($this->equipoCambioActual === 'local') {
            $cambiosRealizados = &$this->cambiosRealizadosLocal;
        } else {
            $cambiosRealizados = &$this->cambiosRealizadosVisita;
        }


        // Validar que el suplente no esté ya en cancha
        foreach ($titulares as $jugador) {
            if ($jugador['numero'] === $equipo['jugadores'][$this->jugadorAEntrarIndex]['numero']) {
                $this->dispatch('alerta', ['mensaje' => 'El jugador suplente ya está en cancha.']);
                return;
            }
        }

        // Realizar cambio
        $jugadorEntrante = $equipo['jugadores'][$this->jugadorAEntrarIndex];
        $jugadorSaliente = $titulares[$this->jugadorASacarIndex];

        $titulares[$this->jugadorASacarIndex] = [
            'numero' => $jugadorEntrante['numero'],
            'nombre' => $jugadorEntrante['nombre'],
            'posicion' => $jugadorSaliente['posicion'],
        ];

        // Guardar cambio
        $cambiosRealizados[] = [
            'salio' => $jugadorSaliente['numero'],
            'entro' => $jugadorEntrante['numero'],
            'posicion' => $jugadorSaliente['posicion'],
        ];

        // Incrementar contador cambios
        if ($this->equipoCambioActual === 'local') {
            $this->contadorCambiosLocal++;
            $this->jugadoresLocalTitulares = $titulares;
        } else {
            $this->contadorCambiosVisita++;
            $this->jugadoresVisitaTitulares = $titulares;
        }

        $this->modalCambioVisible = false;
        $this->jugadorASacarIndex = null;
        $this->jugadorAEntrarIndex = null;

        $this->dispatch('alerta', ['mensaje' => 'Cambio realizado con éxito.']);
    }

    public function cancelarCambio()
    {
        $this->modalCambioVisible = false;
    }
}
