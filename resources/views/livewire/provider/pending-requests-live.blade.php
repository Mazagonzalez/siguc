<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de vehiculo</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th">Cantidad de ordenes</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <x-utils.status status="{{ $request->status }}" />
                    </td>

                    <td class="td">{{ $request->type_vehicle }}</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">{{ $request->date_acceptance }}</td>
                    <td class="td">
                        @if ($request->id_request_double)
                            <p>2</p>
                        @else
                            <p>1</p>
                        @endif
                    </td>

                    <td class="items-center justify-center gap-2 td row">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('provider.decline-request-live', ['request' => $request], key('reject-request-'.$request->id))
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <p class="py-20 text-center">No tienes solicitudes en proceso</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
