<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de solicitud</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de la solicitud</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <x-utils.status status="{{ $request->status }}" />
                    </td>
                    <td class="td">Solicitud Nacional</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">{{ $request->created_at }}</td>
                    <td class="items-center justify-center gap-2 td row" style="text-align: start">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('provider.accept-request-live', ['request' => $request], key('accept-request-'.$request->id))

                        @livewire('provider.decline-request-live', ['request' => $request], key('reject-request-'.$request->id))
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
                    <td class="td">Solicitud termoformado</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">{{ $request->created_at }}</td>
                    <td class="items-center justify-center gap-2 td row" style="text-align: start">
                        @livewire('user.thermoformed.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('user.thermoformed.accept-request-live', ['request' => $request], key('accept-request-'.$request->id))

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
