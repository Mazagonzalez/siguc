<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de solicitud</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th">Flete actual</th>
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
                    <td class="td">{{ $request->date_acceptance }}</td>
                    <td class="td">{{ number_format($request->initial_flete) }}</td>

                    <td class="items-center justify-center gap-2 td row">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('provider.confirm-delivery-live', ['request' => $request], key('confirm-request-'.$request->id))

                        @livewire('provider.decline-request-live', ['request' => $request, 'roleDecline' => 2], key('reject-request-'.$request->id))
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
                    <td class="td">{{ $request->date_acceptance }}</td>
                    <td class="td">{{ number_format($request->initial_flete) }}</td>

                    <td class="items-center justify-center gap-2 td row">
                        @livewire('user.thermoformed.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('user.thermoformed.confirm-delivery-live', ['request' => $request], key('confirm-request-'.$request->id))

                        @livewire('user.thermoformed.decline-requests-live', ['request' => $request, 'roleDecline' => 2], key('reject-request-'.$request->id))

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
