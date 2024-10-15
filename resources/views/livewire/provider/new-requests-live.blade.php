<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">#</th>
                <th class="th">Estado</th>
                <th class="th">Tipo de solicitud</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de la solicitud</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($totalRequests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="font-semibold td">{{ $loop->iteration }}</td>

                    @if ($request->type_request == 'Solicitud nacional')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestNational?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="1" /></td>

                        <td class="td">{{ $request->requestNational?->date_quotation }}</td>

                        <td class="td">{{ $request->requestNational?->created_at }}</td>

                        <td class="items-center justify-center gap-2 td row" style="text-align: start">
                            @livewire('provider.details-request-live', ['request' => $request->requestNational], key('detail-request-national'.$request->id))

                            @livewire('provider.accept-request-live', ['request' => $request->requestNational], key('accept-request-national'.$request->id))

                            @livewire('provider.decline-request-live', ['request' => $request->requestNational], key('reject-request-national'.$request->id))
                        </td>
                    @elseif ($request->type_request == 'Solicitud exportacion')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestExportation?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="2" /></td>

                        <td class="td">{{ $request->requestExportation?->date_quotation }}</td>

                        <td class="td">{{ $request->requestExportation?->created_at }}</td>

                        <td class="items-center justify-center gap-2 td row" style="text-align: start">
                            @livewire('user.exportation.details-request-live', ['request' => $request->requestExportation], key('detail-request-exportation-'.$request->id))

                            @livewire('user.exportation.accept-request-live', ['request' => $request->requestExportation], key('accept-request-exportation-'.$request->id))

                            @livewire('user.exportation.decline-requests-live', ['request' => $request->requestExportation, 'roleDecline' => 2], key('reject-request-exportation-'.$request->id))
                        </td>
                    @elseif ($request->type_request == 'Solicitud termoformado')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestThermoformed?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="3" /></td>

                        <td class="td">{{ $request->requestThermoformed?->date_quotation }}</td>

                        <td class="td">{{ $request->requestThermoformed?->created_at }}</td>

                        <td class="items-center justify-center gap-2 td row" style="text-align: start">
                            @livewire('user.thermoformed.details-request-live', ['request' => $request->requestThermoformed], key('detail-request-thermoformed'.$request->id))

                            @livewire('user.thermoformed.accept-request-live', ['request' => $request->requestThermoformed], key('accept-request-thermoformed'.$request->id))

                            @livewire('user.thermoformed.decline-requests-live', ['request' => $request->requestThermoformed, 'roleDecline' => 2], key('reject-request-thermoformed'.$request->id))
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <x-utils.not-search message="No hay solicitudes finalizadas" colspan="5" py="py-24" />
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
