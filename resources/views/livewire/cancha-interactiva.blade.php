<div class="relative w-full max-w-4xl p-4 mx-auto mt-6 bg-gray-100 rounded-lg shadow-lg">
    <div class="relative inline-block">
        {{-- Imagen de la cancha --}}
        <img src="{{ asset('images/cancha.jpg') }}" alt="Cancha de vóley" class="block h-auto max-w-full" />

        {{-- Botón para seleccionar titulares si aún no se han cargado --}}
        @if (!$modoSeleccionTitulares && empty($jugadoresLocalTitulares) && empty($jugadoresVisitaTitulares))
            <button wire:click="seleccionarTitulares"
                class="absolute z-30 px-4 py-2 text-white transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded shadow top-1/2 left-1/2 hover:bg-blue-700">
                Cargar Titulares
            </button>
        @endif

        {{-- Rejilla 3x6 --}}
        <div class="absolute inset-0 z-10 grid grid-cols-6 grid-rows-3 pointer-events-none">
            @for ($fila = 0; $fila < 3; $fila++)
                @for ($col = 0; $col < 6; $col++)
                    <div class="relative border border-gray-300/40">
                        {{-- <span class="absolute text-[10px] text-gray-400 top-0 left-0">{{ $fila+1 }},{{ $col+1 }}</span> --}}
                    </div>
                @endfor
            @endfor
        </div>

        {{-- Posiciones y cálculo de porcentaje por fila/columna --}}
        @php
            $posicionesLocal = [[3, 2], [3, 3], [2, 3], [1, 3], [1, 2], [2, 2]];
            $posicionesVisita = [[1, 5], [1, 4], [2, 4], [3, 4], [3, 5], [2, 5]];

            $filas = 3;
            $columnas = 6;
            $filaAlto = 100 / $filas;
            $colAncho = 100 / $columnas;
        @endphp

        {{-- Mostrar jugadores del equipo local --}}
        @foreach ($jugadoresLocalTitulares as $i => $jugador)
            @php
                if (isset($posicionesLocal[$i])) {
                    [$fila, $col] = $posicionesLocal[$i];
                    $top = $filaAlto * ($fila - 0.5);
                    $left = $colAncho * ($col - 0.5);
                }
            @endphp
            <div class="absolute z-30 flex items-center justify-center w-8 h-8 text-sm font-bold text-white bg-blue-600 rounded-full"
                style="top: {{ $top }}%; left: {{ $left }}%; transform: translate(-50%, -50%);">
                {{ $jugador['numero'] }}
            </div>
        @endforeach

        {{-- Mostrar jugadores del equipo visita --}}
        @foreach ($jugadoresVisitaTitulares as $i => $jugador)
            @php
                if (isset($posicionesVisita[$i])) {
                    [$fila, $col] = $posicionesVisita[$i];
                    $top = $filaAlto * ($fila - 0.5);
                    $left = $colAncho * ($col - 0.5);
                }
            @endphp
            <div class="absolute z-30 flex items-center justify-center w-8 h-8 text-sm font-bold text-white bg-red-600 rounded-full"
                style="top: {{ $top }}%; left: {{ $left }}%; transform: translate(-50%, -50%);">
                {{ $jugador['numero'] }}
            </div>
        @endforeach

        {{-- Modal de selección de titulares --}}
        @if ($modoSeleccionTitulares)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-3xl p-6 bg-white rounded shadow-lg">

                    <h2 class="mb-2 text-lg font-bold text-gray-800">Asignar Jugadores a Posiciones (Ⅰ a Ⅵ)</h2>

                    <div class="grid grid-cols-2 gap-6">
                        {{-- Local --}}
                        <div>
                            <h3 class="mb-2 font-semibold text-blue-700">Equipo Local</h3>
                            @foreach (range(0, 5) as $i)
                                <div class="mb-2">
                                    <label class="block mb-1 text-sm text-gray-700">Posición
                                        {{ ['Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', 'Ⅵ'][$i] }}</label>
                                    <select wire:model="asignacionTitularesLocal.{{ $i }}"
                                        class="w-full p-2 border rounded">
                                        <option value="">-- Seleccionar Jugador --</option>
                                        @foreach ($equipoLocal['jugadores'] as $index => $jugador)
                                            @if ($jugador['nombre'])
                                                <option value="{{ $index }}">
                                                    #{{ $jugador['numero'] }} - {{ $jugador['nombre'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        {{-- Visita --}}
                        <div>
                            <h3 class="mb-2 font-semibold text-red-700">Equipo Visita</h3>
                            @foreach (range(0, 5) as $i)
                                <div class="mb-2">
                                    <label class="block mb-1 text-sm text-gray-700">Posición
                                        {{ ['Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', 'Ⅵ'][$i] }}</label>
                                    <select wire:model="asignacionTitularesVisita.{{ $i }}"
                                        class="w-full p-2 border rounded">
                                        <option value="">-- Seleccionar Jugador --</option>
                                        @foreach ($equipoVisita['jugadores'] as $index => $jugador)
                                            @if ($jugador['nombre'])
                                                <option value="{{ $index }}">
                                                    #{{ $jugador['numero'] }} - {{ $jugador['nombre'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-4 text-right">
                        <button wire:click="$set('modoSeleccionTitulares', false)"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            Cancelar
                        </button>
                        <button wire:click="confirmarTitulares"
                            class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                            Confirmar Titulares
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            Livewire.on('titulares-guardados', (datos) => {
                localStorage.setItem('jugadoresLocalTitulares', JSON.stringify(datos.local));
                localStorage.setItem('jugadoresVisitaTitulares', JSON.stringify(datos.visita));
                console.log('Titulares guardados en localStorage', datos);
            });

            document.addEventListener('livewire:load', () => {
                const local = localStorage.getItem('jugadoresLocalTitulares');
                const visita = localStorage.getItem('jugadoresVisitaTitulares');

                if (local && visita) {
                    try {
                        Livewire.emit('cargarTitularesDesdeJS', {
                            local: JSON.parse(local),
                            visita: JSON.parse(visita)
                        });
                        console.log('Titulares cargados desde localStorage');
                    } catch (e) {
                        console.error('Error al parsear titulares desde localStorage', e);
                    }
                }
            });

            Livewire.on('alerta', event => {
                let mensaje = 'Mensaje no definido';

                if (Array.isArray(event) && event.length > 0) {
                    mensaje = event[0]?.mensaje ?? JSON.stringify(event);
                } else if (typeof event === 'object') {
                    mensaje = event.mensaje ?? JSON.stringify(event);
                } else if (typeof event === 'string') {
                    mensaje = event;
                }

                alert(mensaje);
            });
        </script>
    @endpush
</div>
