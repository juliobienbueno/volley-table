<div class="min-w-full overflow-hidden border border-gray-200 rounded-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Nombre</th>
                    <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Número</th>
                    <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Posición</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($form[$equipo] as $i => $jugador)
                    <tr wire:key="jugador-{{ $equipo }}-{{ $i }}"
                        class="transition-colors hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input wire:model="form.{{ $equipo }}.{{ $i }}.nombre" type="text"
                                placeholder="Nombre jugador"
                                class="w-full p-2 text-sm border rounded focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input wire:model="form.{{ $equipo }}.{{ $i }}.numero" type="number"
                                min="1" max="99" placeholder="00"
                                class="w-full p-2 text-sm border rounded focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <select wire:model="form.{{ $equipo }}.{{ $i }}.posicion"
                                class="w-full p-2 text-sm border rounded focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Seleccionar</option>
                                @foreach ($posiciones as $pos)
                                    <option value="{{ $pos }}">{{ $pos }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
