<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VolleyTable</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="relative flex flex-col min-h-screen font-sans antialiased" style="background-image: url('{{asset('images/background.jpg')}}'); background-size: cover">

    <x-navbar />

    <main class="flex items-center justify-center flex-grow px-4 py-6">
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
    @stack('scripts')

</body>

</html>
