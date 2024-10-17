<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">#</th>
                <th class="th">Estado</th>
                <th class="th">Tipo de solicitud</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de finalizacion/cancelacion</th>
                <th class="th">Flete Final</th>
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

                        <td class="td">
                            @if ($request->requestNational?->status == 2)
                                {{ $request->requestNational?->date_decline }}
                            @elseif ($request->requestNational?->status == 5)
                                {{ $request->requestNational?->date_loading }}
                            @endif
                        </td>

                        <td class="td">
                            @if ($request->requestNational?->status == 5)
                                {{ number_format($request->requestNational?->final_flete) }}
                            @elseif ($request->requestNational?->status == 2)
                                <p>Cancelada</p>
                            @endif
                        </td>

                        <td class="flex justify-center td">
                            @livewire('provider.details-request-live', ['request' => $request->requestNational], key('detail-request-national-'.$request->requestNational->id))
                        </td>
                    @elseif ($request->type_request == 'Solicitud exportacion')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestExportation?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="2" /></td>

                        <td class="td">{{ $request->requestExportation?->date_quotation }}</td>

                        <td class="td">
                            @if ($request->requestExportation?->status == 2)
                                {{ $request->requestExportation?->date_decline }}
                            @elseif ($request->requestExportation?->status == 5)
                                {{ $request->requestExportation?->date_loading }}
                            @endif
                        </td>

                        <td class="td">
                            @if ($request->requestExportation?->status == 5)
                                {{ number_format($request->requestExportation?->total_final_flete) }}
                            @elseif ($request->requestExportation?->status == 2)
                                <p>Cancelada</p>
                            @endif
                        </td>

                        <td class="flex justify-center td">
                            @livewire('user.exportation.details-request-live', ['request' => $request->requestExportation], key('detail-request-exportation-'.$request->requestExportation->id))
                        </td>
                    @elseif ($request->type_request == 'Solicitud termoformado')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestThermoformed?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="3" /></td>

                        <td class="td">{{ $request->requestThermoformed?->date_quotation }}</td>

                        <td class="td">
                            @if ($request->requestThermoformed?->status == 2)
                                {{ $request->requestThermoformed?->date_decline }}
                            @elseif ($request->requestThermoformed?->status == 5)
                                {{ $request->requestThermoformed?->date_loading }}
                            @endif
                        </td>

                        <td class="td">
                            @if ($request->requestThermoformed?->status == 5)
                                {{ number_format($request->requestThermoformed?->final_flete) }}
                            @elseif ($request->requestThermoformed?->status == 2)
                                <p>Cancelada</p>
                            @endif
                        </td>

                        <td class="flex justify-center td">
                            @livewire('user.thermoformed.details-request-live', ['request' => $request->requestThermoformed], key('detail-request-thermoformed-'.$request->requestThermoformed->id))
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
