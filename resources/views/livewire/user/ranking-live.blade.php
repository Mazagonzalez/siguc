<div>
    <table class="w-full">
        <tbody>
            @forelse ($providers as $index => $provider)
                @if ($index <= 4)
                    <tr class="tr">
                        <td>
                            <div class="center-content">
                                @if ($index == 0)
                                    <x-icons.medal position="1" class="stroke-yellow-400 size-7" />
                                @elseif ($index == 1)
                                    <x-icons.medal position="2" class="stroke-gray-400 size-7" />
                                @elseif ($index == 2)
                                    <x-icons.medal position="3" class="stroke-orange-500 size-7" />
                                @elseif ($index == 3 || $index == 4)
                                    <x-icons.medal class="stroke-[#a0642c] size-7" />
                                @else
                                    # {{ $index }}
                                @endif
                            </div>
                        </td>

                        <td class="font-light td">
                            {{ auth()->user()->short($provider->provider->company_name, 20) }}
                        </td>

                        <td class="font-light td">
                            {{ $provider->total }}
                        </td>

                        <th class="font-semibold td">
                            @if ($totalStates > 0)
                                {{ number_format(($provider->total / $totalStates) * 100, 2) }}%
                            @endif
                        </th>
                    </tr>
                @endif
            @empty
                <tr>
                    <x-utils.not-search message="No hay solicitudes finalizadas" colspan="4" py="20" />
                </tr>
            @endforelse
        </tbody>
    </table>

    <x-dialog-modal wire:model='open' maxWidth="lg" title="Ranking de solicitudes finalizadas" >
        <x-slot name="content">
            <table class="w-full mt-5">
                <thead>
                    <tr class="tr">
                        <th class="th">Posición</th>
                        <th class="th">Proveedores</th>
                        <th class="th">Total</th>
                        <th class="th">Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($providers as $index => $provider)
                        <tr class="tr">
                            <td>
                                <div class="center-content">
                                    @if ($index == 0)
                                        <x-icons.medal position="1" class="stroke-yellow-400 size-7" />
                                    @elseif ($index == 1)
                                        <x-icons.medal position="2" class="stroke-gray-400 size-7" />
                                    @elseif ($index == 2)
                                        <x-icons.medal position="3" class="stroke-orange-500 size-7" />
                                    @elseif ($index == 3 || $index == 4)
                                        <x-icons.medal class="stroke-[#a0642c] size-7" />
                                    @else
                                        # {{ $index }}
                                    @endif
                                </div>
                            </td>

                            <td class="font-light td">
                                {{ auth()->user()->short($provider->provider->company_name, 20) }}
                            </td>

                            <td class="font-light td">
                                {{ $provider->total }}
                            </td>

                            <th class="font-semibold td">
                                @if ($totalStates > 0)
                                    {{ number_format(($provider->total / $totalStates) * 100, 2) }}%
                                @endif
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <x-utils.not-search message="No hay solicitudes finalizadas" colspan="4" py="20" />
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="$set('open', false)" class="btn-close-modal">Cerrar</button>
        </x-slot>
    </x-dialog-modal>
</div>
