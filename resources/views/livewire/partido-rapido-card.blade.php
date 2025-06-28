<div class="max-w-md p-6 mx-auto bg-white border border-gray-200 rounded-lg shadow-md">
    <!-- Tarjeta -->
    <div class="text-center">
        <h3 class="mb-2 text-xl font-bold text-gray-800">Partido Rápido</h3>
        <p class="mb-4 text-gray-600">Comienza un partido sin registro. ¡Configura y juega!</p>

        <button wire:click="openModal"
            class="flex items-center px-4 py-2 mx-auto text-white transition bg-orange-500 rounded-lg hover:bg-orange-600">
            Iniciar Partido 🏐
        </button>
    </div>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 overflow-auto bg-black bg-opacity-50">
            <div class="relative w-full max-w-6xl mx-auto bg-white shadow-xl"
                style="max-height: calc(100vh - 100px); height: calc(100vh - 100px);">
                <div class="flex flex-col h-full">
                    <!-- Encabezado y Tabs -->
                    <div class="sticky top-0 z-10 p-6 pb-0 bg-white border-b">
                        <h3 class="mb-4 text-xl font-bold text-center">Configuración del Partido</h3>

                        <div class="overflow-x-auto">
                            <div class="flex justify-center">
                                <nav class="flex justify-center space-x-4 min-w-max">
                                    @foreach ([
        'partido' => 'Datos del Partido',
        'local' => 'Equipo Local',
        'visita' => 'Equipo Visita',
        'oficiales' => 'Árbitros y Oficiales',
    ] as $key => $label)
                                        <button type="button" wire:click="$set('tabActual', '{{ $key }}')"
                                            class="{{ $tabActual === $key ? 'border-b-2 border-orange-500 font-bold' : '' }} px-3 py-2 text-sm whitespace-nowrap">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido con scroll -->
                    <div class="flex-1 px-6 pt-4 pb-6 overflow-hidden">
                        <form wire:submit.prevent="guardarPartido">
                            @if ($tabActual === 'partido')
                                <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Lugar</label>
                                        <input wire:model="form.lugar" type="text" class="w-full p-2 border rounded">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nombre de la Cancha</label>
                                        <input wire:model="form.cancha" type="text" class="w-full p-2 border rounded">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Equipo Local</label>
                                        <input wire:model="form.equipoA" type="text" class="w-full p-2 border rounded">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Equipo Visita</label>
                                        <input wire:model="form.equipoB" type="text" class="w-full p-2 border rounded">
                                    </div>
                                </div>
                            @endif

                            @if ($tabActual === 'local')
                                <div class="flex flex-col h-full">
                                    <div class="flex justify-center mb-4 space-x-4">
                                        <div class="w-full md:w-1/2">
                                            <label class="block text-sm font-medium">Entrenador</label>
                                            <input wire:model="form.entrenadorA" type="text" class="w-full px-2 py-1 text-sm border rounded">
                                        </div>
                                        <div class="w-full md:w-1/2">
                                            <label class="block text-sm font-medium">Asistente</label>
                                            <input wire:model="form.asistenteA" type="text" class="w-full px-2 py-1 text-sm border rounded">
                                        </div>
                                    </div>

                                    <div class="flex-1 overflow-y-auto border rounded-lg">
                                        <div class="overflow-y-auto max-h-[500px] pb-16">
                                            @include('livewire.partials.jugadores', [
                                                'equipo' => 'jugadoresA',
                                                'form' => $form,
                                                'posiciones' => $posiciones,
                                            ])
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($tabActual === 'visita')
                                <div class="flex justify-center mb-4 space-x-4">
                                    <div class="w-full md:w-1/2">
                                        <label class="block text-sm font-medium">Entrenador</label>
                                        <input wire:model="form.entrenadorB" type="text" class="w-full px-2 py-1 text-sm border rounded">
                                    </div>
                                    <div class="w-full md:w-1/2">
                                        <label class="block text-sm font-medium">Asistente</label>
                                        <input wire:model="form.asistenteB" type="text" class="w-full px-2 py-1 text-sm border rounded">
                                    </div>
                                </div>

                                <div class="flex-1 min-h-0 overflow-hidden border rounded-lg">
                                    <div class="overflow-y-auto max-h-[500px] pb-16">
                                        @include('livewire.partials.jugadores', [
                                            'equipo' => 'jugadoresB',
                                            'form' => $form,
                                            'posiciones' => $posiciones,
                                        ])
                                    </div>
                                </div>
                            @endif

                            @if ($tabActual === 'oficiales')
                                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                                    @foreach ([0, 1] as $i)
                                        <div>
                                            <label class="block text-sm">Árbitro {{ $i + 1 }}</label>
                                            <input wire:model="form.arbitros.{{ $i }}" type="text" class="w-full p-2 border rounded">
                                        </div>
                                    @endforeach
                                    @foreach (range(0, 3) as $i)
                                        <div>
                                            <label class="block text-sm">Juez Línea {{ $i + 1 }}</label>
                                            <input wire:model="form.juecesLinea.{{ $i }}" type="text" class="w-full p-2 border rounded">
                                        </div>
                                    @endforeach
                                    <div>
                                        <label class="block text-sm">Marcador</label>
                                        <input wire:model="form.mesa.marcador" type="text" class="w-full p-2 border rounded">
                                    </div>
                                    <div>
                                        <label class="block text-sm">Asistente Mesa</label>
                                        <input wire:model="form.mesa.asistente" type="text" class="w-full p-2 border rounded">
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>

                    <!-- Botones fijos -->
                    <div class="sticky bottom-0 z-10 p-4 bg-white border-t">
                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="resetModal"
                                class="px-4 py-2 bg-gray-300 rounded-lg">Cancelar</button>
                            <button type="submit" wire:click="guardarPartido" wire:loading.attr="disabled"
                                class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50">
                                <span wire:loading.remove>Guardar y Comenzar</span>
                                <span wire:loading>Guardando...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            // Cargar datos guardados al iniciar
            const savedData = localStorage.getItem('partido_config');
            if (savedData) {
                Livewire.dispatch('loadSavedData', { datos: JSON.parse(savedData) });
            }

            // Escuchar evento para guardar en localStorage
            Livewire.on('datosGuardados', (datos) => {
                localStorage.setItem('partido_config', JSON.stringify(datos));
            });
        });
    </script>
@endpush
