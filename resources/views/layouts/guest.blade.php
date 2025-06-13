<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen font-sans antialiased" style="background-image: url('{{asset('images/background.jpg')}}'); background-size: cover">
    <x-navbar />
    <main class="flex items-center justify-center flex-grow px-4 py-6">
        <div class="w-full max-w-md">
            <div class="font-sans antialiased text-gray-900">
                {{ $slot }}
            </div>
        </div>
    </main>


    <x-footer />
    @livewireScripts
    @stack('scripts')
</body>

</html>
