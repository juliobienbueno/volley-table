<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <h1 class="mb-6 text-2xl font-bold">Panel de Administración</h1>

                <div class="grid max-w-xl grid-cols-1 gap-6 mx-auto md:grid-cols-2">
                    <a href="{{ route('equipos.index') }}" class="block p-6 text-center text-white transition bg-blue-600 rounded hover:bg-blue-700">
                        Gestión de Equipos
                    </a>

                    <a href="{{ route('cuerpo-arbitros.index') }}" class="block p-6 text-center text-white transition bg-green-600 rounded hover:bg-green-700">
                        Gestión de Cuerpos Arbitrales
                    </a>

                    <a href="{{ route('partidos.index') }}" class="block p-6 text-center text-white transition bg-yellow-600 rounded hover:bg-yellow-700">
                        Gestión de Partidos
                    </a>

                    <a href="{{ route('reportes.index') }}" class="block p-6 text-center text-white transition bg-red-600 rounded hover:bg-red-700">
                        Gestión de Reportes
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
