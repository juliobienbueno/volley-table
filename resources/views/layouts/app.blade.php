<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VolleyTable</title>

    <!-- Precargar la imagen para mejor performance -->
    <link rel="preload" as="image" href="{{ asset('images/background.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="relative flex flex-col min-h-screen font-sans antialiased">
    <!-- Div de fondo fijo CORREGIDO -->
    <div
        class="fixed inset-0 bg-center bg-no-repeat bg-cover -z-10"
        style="background-image: url('{{ asset('images/background.jpg') }}');"
    ></div>

    <!-- Contenido principal (se muestra encima del fondo) -->
    <div class="relative flex flex-col min-h-screen">
        <x-navbar />

        <main class="flex items-center justify-center flex-grow px-4 py-6">
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
