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
                    <th class="th">Flete total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tr">
                    <td class="td">1</td>

                    <td class="td" style="text-align: start">
                        <p class="text-sm tooltip tooltip-top" data-tip="LINKARGA">
                            {{ auth()->user()->short('LINKARGA', 15) }}
                        </p>
                    </td>

                    <th class="th">
                        7
                    </th>

                    <th class="th">
                        $ 23.200,00
                    </th>
                </tr>

                <tr class="tr">
                    <td class="td">2</td>

                    <td class="td" style="text-align: start">
                        <p class="text-sm tooltip tooltip-top" data-tip="COLTANQUES S.A.S">
                            {{ auth()->user()->short('COLTANQUES S.A.S', 15) }}
                        </p>
                    </td>

                    <th class="th">
                        5
                    </th>

                    <th class="th">
                        $ 18.000,00
                    </th>
                </tr>

                <tr class="tr">
                    <td class="td">3</td>

                    <td class="td" style="text-align: start">
                        <p class="text-sm tooltip tooltip-top" data-tip="TANQUES DEL NOROESTE">
                            {{ auth()->user()->short('TANQUES DEL NOROESTE', 15) }}
                        </p>
                    </td>

                    <th class="th">
                        3
                    </th>

                    <th class="th">
                        $ 15.600,00
                    </th>
                </tr>

                <tr class="tr">
                    <td class="td">4</td>

                    <td class="td" style="text-align: start">
                        <p class="text-sm tooltip tooltip-top" data-tip="TRANSPORTADORA MULTIGLOBAL S.A.S">
                            {{ auth()->user()->short('TRANSPORTADORA MULTIGLOBAL S.A.S', 15) }}
                        </p>
                    </td>

                    <th class="th">
                       2
                    </th>

                    <th class="th">
                        $ 9.200,00
                    </th>
                </tr>

                <tr class="tr" style="border-bottom: 0px">
                    <td class="td">5</td>

                    <td class="td" style="text-align: start">
                        <p class="text-sm tooltip tooltip-top" data-tip="COORDINADORA">
                            {{ auth()->user()->short('COORDINADORA', 15) }}
                        </p>
                    </td>

                    <th class="th">
                        1
                    </th>

                    <th class="th">
                        $ 4.500,00
                    </th>
                </tr>

               {{--  @forelse ($providers as $index => $provider)
                    <tr class="tr" @if ($index === 4) style="border-bottom: 0px" @endif>
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
                @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
