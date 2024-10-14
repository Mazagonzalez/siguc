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
                    <th class="th">Porcentage</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($providerCounts as $providerName => $total)
                    <tr class="tr">
                        <td class="td">{{ $loop->iteration }}</td>

                        <td class="td" style="text-align: start">
                            <p class="text-sm tooltip tooltip-top" data-tip="{{ $providerName }}">
                                {{ auth()->user()->short($providerName, 15) }}
                            </p>
                        </td>

                        <th class="th">
                            {{ $total }}
                        </th>

                        <th class="td">
                            @if ($totalStates > 0)
                                {{ number_format(($total / $totalStates) * 100, 2) }}%
                            @else
                                0%
                            @endif
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
