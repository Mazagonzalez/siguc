<div class="gap-3 col">
    <div class="p-6 card-theme min-h-[394px]">
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
                    <th class="th">Flete Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($providerCounts as $providerName => $total)
                    @if ($loop->iteration <= 5)
                        <tr class="tr" @if ($loop->iteration == 5) style="border-bottom: 0px" @endif>
                            <td class="td">{{ $loop->iteration }}</td>

                            <td class="td" style="text-align: start">
                                <p class="text-sm tooltip tooltip-top" data-tip="{{ $providerName }}">
                                    {{ auth()->user()->short($providerName, 15) }}
                                </p>
                            </td>

                            <td class="font-bold td">
                                {{ $total }}
                            </td>

                            <td class="font-bold td">
                                $ {{ number_format($providerFleteTotal[$providerName] ?? 0, 0) }}
                            </td>
                        </tr>
                    @else
                        @break
                    @endif
                @empty
                    <tr>
                        <x-utils.not-search message="No hay solicitudes finalizadas" colspan="4" py="py-20" />
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
