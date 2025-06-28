<x-app-layout>
    <div class="grid grid-cols-4 grid-rows-2 gap-2 p-2 overflow-hidden h-dvh">

        {{-- Tablero (fila 1, columnas 1-3) --}}
        <div class="col-span-3 row-start-1">
            @livewire('tablero-puntaje')
        </div>

        {{-- Cancha (fila 2, columnas 1-3) --}}
        <div class="col-span-3 row-start-2 overflow-hidden">
            @livewire('cancha-interactiva')
        </div>

        {{-- Lista de acciones (filas 1-2, columna 4) --}}
        <div class="flex flex-col col-start-4 row-span-2 p-4 bg-white rounded shadow">
            <h2 class="mb-2 text-lg font-semibold">Historial</h2>
            <ul class="flex-1 pr-1 space-y-1 overflow-y-auto text-sm">
                <li>Punto 1</li>
                <li>Punto 2</li>
                {{-- Aquí irá tu componente de historial más adelante --}}
            </ul>
        </div>

    </div>
</x-app-layout>
