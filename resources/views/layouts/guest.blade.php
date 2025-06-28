<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Precargar imagen -->
    <link rel="preload" as="image" href="{{ asset('images/background.jpg') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="relative flex flex-col min-h-screen font-sans antialiased">

    <!-- Fondo fijo detrás de todo -->
    <div
        class="fixed inset-0 bg-center bg-no-repeat bg-cover -z-10"
        style="background-image: url('{{ asset('images/background.jpg') }}');"
    ></div>

    <!-- Contenido principal -->
    <div class="relative flex flex-col min-h-screen">
        <x-navbar />

        <main class="flex items-center justify-center flex-grow px-4 py-6">
            <div class="w-full max-w-md text-gray-900">
                {{ $slot }}
            </div>
        </main>

        <x-footer />
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
