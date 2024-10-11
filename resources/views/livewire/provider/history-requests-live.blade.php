<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de solicitud</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de finalizacion/cancelacion</th>
                <th class="th">Flete Final</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <x-utils.status status="{{ $request->status }}" />
                    </td>

                    <td class="td">Solicitud nacional</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">
                        @if ($request->status == 2)
                            {{ $request->date_decline }}
                        @elseif ($request->status == 5)
                            {{ $request->date_loading }}
                        @endif
                    </td>
                    <td class="td">
                        @if ($request->status == 5)
                            {{ number_format($request->final_flete) }}
                        @elseif ($request->status == 2)
                            <p>Cancelada</p>
                        @endif
                    </td>
                    <td class="flex justify-center td">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))
                    </td>
                </tr>
            @empty
                @forelse($requestsThermoformed as $request)
                @empty
                    <tr>
                        <td colspan="5">
                            <p class="py-20 text-center">No tienes solicitudes en proceso</p>
                        </td>
                    </tr>
                @endforelse
            @endforelse
            @forelse($requestsThermoformed as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <x-utils.status status="{{ $request->status }}" />
                    </td>

                    <td class="td">Solicitudes termoformado</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">
                        @if ($request->status == 2)
                            {{ $request->date_decline }}
                        @elseif ($request->status == 5)
                            {{ $request->date_loading }}
                        @endif
                    </td>
                    <td class="td">
                        @if ($request->status == 5)
                            {{ number_format($request->final_flete) }}
                        @elseif ($request->status == 2)
                            <p>Cancelada</p>
                        @endif
                    <td class="flex justify-center td">
                        @livewire('user.thermoformed.details-request-live', ['request' => $request], key('detail-request-'.$request->id))
                    </td>
                </tr>
            @empty
                @forelse($requests as $request)
                @empty
                    <tr>
                        <td colspan="5">
                            <p class="py-20 text-center">No tienes solicitudes en proceso</p>
                        </td>
                    </tr>
                @endforelse
            @endforelse
        </tbody>
    </table>
</div>
