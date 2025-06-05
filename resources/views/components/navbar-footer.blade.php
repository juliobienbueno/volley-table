<nav class="flex items-center justify-between px-6 py-3 text-white bg-green-600">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/volleyball-icon.png') }}" alt="Volley Icon" class="w-8 h-8">
        <span class="text-xl font-bold">VolleyTable</span>
    </div>

    @auth
        <div class="relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium hover:text-gray-200 focus:outline-none">
                        <div>{{ Auth::user()->name }}</div>
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5.23 7.21l4.77 4.77 4.77-4.77L16 8.27l-6 6-6-6z"/>
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.show')">
                        Perfil
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Cerrar sesión
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    @else
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="hover:underline">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="hover:underline">Registrarse</a>
        </div>
    @endauth
</nav>

<footer class="py-4 mt-10 text-white bg-gray-800">
    <div class="flex justify-center space-x-8">
        <a href="#contacto" class="hover:underline">Contáctenme</a>
        <a href="https://www.fivb.com/en/volleyball/thegame_glossary" target="_blank" class="hover:underline">Reglas FIVB</a>
    </div>
</footer>
