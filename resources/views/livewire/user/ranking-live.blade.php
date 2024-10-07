<div class="gap-3 col">
    <div class="p-6 card-theme min-h-[320px]">
        <div>
            <p class="text-lg font-semibold">Ranking top 5</p>

            <div class="px-2 text-xs text-indigo-500 bg-indigo-100 rounded-full w-fit">
                Solicitudes Finalizadas
            </div>
        </div>

        <table class="w-full mt-5">
            <thead>
                <tr class="tr">
                    <th class="th">#</th>
                    <th class="th text-start">Proveedor</th>
                    <th class="th">Total</th>
                    <th class="th">Porcentaje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($providers as $index => $provider)
                    <tr class="tr">
                        <td class="td">{{ $index + 1 }}</td>

                        <td class="td" style="text-align: start">
                            <p class="text-sm tooltip tooltip-top" data-tip="{{ $provider->provider->company_name }}">
                                {{ auth()->user()->short($provider->provider->company_name, 15) }}
                            </p>
                        </td>

                        <th class="th">
                            {{ $provider->total }}
                        </th>

                        <th class="td">
                            {{ number_format(($provider->total / $totalStates) * 100, 2) }}%
                        </th>
                    </tr>
                @empty
                    <tr>
                        <x-utils.not-search message="No hay solicitudes finalizadas" colspan="4" py="py-20" />
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
