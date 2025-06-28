<div class="w-full max-w-4xl p-4 mx-auto bg-white rounded-lg shadow-md">
    <div class="flex items-center justify-center gap-12 text-gray-800">

        {{-- Equipo Local --}}
        <div class="flex flex-col items-center space-y-4">
            <button wire:click="sumarPunto('local')"
                class="px-6 py-3 text-lg font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                + Punto
            </button>

            <div class="text-center">
                <button wire:click="pedirTiempo('local')"
                    class="px-4 py-1 mr-2 text-sm bg-gray-200 rounded hover:bg-gray-300">
                    Tiempo ({{ $tiemposLocal }}/2)
                </button>
                {{-- Emitir evento al componente cancha-interactiva para abrir modal --}}
                <button wire:click="$dispatch('abrirModalCambio', 'local')"
                    class="px-4 py-1 text-sm bg-gray-200 rounded hover:bg-gray-300">
                    Cambio ({{ $cambiosLocal }}/6)
                </button>
            </div>
        </div>

        {{-- Puntajes en el centro --}}
        <div class="flex items-center space-x-4 text-5xl font-bold">
            <div class="text-blue-600 {{ $saque === 'local' ? 'underline' : '' }}">
                {{ $puntosLocal }}
            </div>
            <div class="text-gray-500">:</div>
            <div class="text-red-600 {{ $saque === 'visita' ? 'underline' : '' }}">
                {{ $puntosVisita }}
            </div>
        </div>

        {{-- Equipo Visita --}}
        <div class="flex flex-col items-center space-y-4">
            <button wire:click="sumarPunto('visita')"
                class="px-6 py-3 text-lg font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                + Punto
            </button>

            <div class="text-center">
                <button wire:click="pedirTiempo('visita')"
                    class="px-4 py-1 mr-2 text-sm bg-gray-200 rounded hover:bg-gray-300">
                    Tiempo ({{ $tiemposVisita }}/2)
                </button>
                {{-- Emitir evento al componente cancha-interactiva para abrir modal --}}
                <button wire:click="$dispatch('abrirModalCambio', 'visita')"
                    class="px-4 py-1 text-sm bg-gray-200 rounded hover:bg-gray-300">
                    Cambio ({{ $cambiosVisita }}/6)
                </button>
            </div>
        </div>
    </div>
</div>
