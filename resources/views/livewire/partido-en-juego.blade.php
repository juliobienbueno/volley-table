<div class="p-6 space-y-4">
    <h2 class="text-xl font-bold text-center">Partido en Juego: {{ $form['equipoA'] }} vs {{ $form['equipoB'] }}</h2>

    <!-- Cancha (puedes reemplazar con un componente más visual) -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h3 class="font-semibold">{{ $form['equipoA'] }}</h3>
            <ul>
                @foreach ($form['jugadoresA'] as $j)
                    @if ($j['nombre'])
                        <li>{{ $j['numero'] }} - {{ $j['nombre'] }} ({{ $j['posicion'] }})</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div>
            <h3 class="font-semibold">{{ $form['equipoB'] }}</h3>
            <ul>
                @foreach ($form['jugadoresB'] as $j)
                    @if ($j['nombre'])
                        <li>{{ $j['numero'] }} - {{ $j['nombre'] }} ({{ $j['posicion'] }})</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Marcador -->
    <div class="flex justify-center space-x-8 text-2xl font-bold">
        <div>
            {{ $form['equipoA'] }}<br>
            {{ $puntosA }} puntos<br>
            {{ $setA }} sets<br>
            <button wire:click="sumarPunto('A')">+1</button>
            <button wire:click="restarPunto('A')">-1</button>
            <br>Tiempos: {{ $tiemposA }} | Cambios: {{ $cambiosA }}
        </div>
        <div>
            {{ $form['equipoB'] }}<br>
            {{ $puntosB }} puntos<br>
            {{ $setB }} sets<br>
            <button wire:click="sumarPunto('B')">+1</button>
            <button wire:click="restarPunto('B')">-1</button>
            <br>Tiempos: {{ $tiemposB }} | Cambios: {{ $cambiosB }}
        </div>
    </div>
</div>
