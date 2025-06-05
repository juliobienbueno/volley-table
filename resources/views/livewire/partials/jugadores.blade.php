<div class="min-w-full">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="sticky top-0 bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Nombre</th>
                <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Número</th>
                <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Posición</th>
                <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase whitespace-nowrap">Capitán</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach(range(0, 15) as $i)
            <tr>
                <td class="px-4 py-2 whitespace-nowrap">
                    <input wire:model="form.{{ $equipo }}.{{ $i }}.nombre" type="text"
                           class="w-full p-1 border rounded">
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <input wire:model="form.{{ $equipo }}.{{ $i }}.numero" type="number"
                           class="w-full p-1 border rounded">
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <select wire:model="form.{{ $equipo }}.{{ $i }}.posicion"
                            class="w-full p-1 border rounded">
                        <option value="">Seleccionar</option>
                        @foreach($posiciones as $pos)
                        <option value="{{ $pos }}">{{ $pos }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="px-4 py-2 text-center whitespace-nowrap">
                    <input type="radio" wire:model="form.{{ $capitanKey }}"
                           value="{{ $i }}" class="text-orange-600 form-radio">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
