<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">#</th>
                <th class="th">Estado</th>
                <th class="th">Tipo de solicitud</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th">Flete actual</th>
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

                        <td class="td">{{ $request->requestNational?->date_acceptance }}</td>

                        <td class="td">{{ number_format($request->requestNational?->initial_flete) }}</td>

                        <td class="items-center justify-center gap-2 td row">
                            @livewire('provider.details-request-live', ['request' => $request->requestNational], key('detail-request-national'.$request->requestNational->id))

                            @if ($request->requestNational?->status == 1)
                                @livewire('provider.upload-invoice', ['request' => $request->requestNational], key('invoice-request-national'.$request->requestNational->id))
                                <button
                                    wire:key="confirm-delevery-{{ $request->requestNational->id }}"
                                    class="bg-gray-500 btn-free-color tooltip tooltip-top"
                                    data-tip="Confirmar entrega"
                                >
                                    <x-icons.checked class="size-5 stroke-white" />
                                </button>
                            @elseif ($request->requestNational?->status == 3)
                                <button
                                    wire:key="updated-invoice-{{ $request->requestNational->id }}"
                                    class="bg-gray-500 btn-free-color tooltip tooltip-top"
                                    data-tip="Subir factura"
                                >
                                    <x-icons.message-check class="size-5 stroke-white" />
                                </button>
                                @livewire('provider.confirm-delivery-live', ['request' => $request->requestNational], key('confirm-request-national'.$request->requestNational->id))
                            @endif

                            @livewire('provider.decline-request-live', ['request' => $request->requestNational, 'roleDecline' => 2], key('reject-request-national'.$request->requestNational->id))
                        </td>
                    @elseif ($request->type_request == 'Solicitud exportacion')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestExportation?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="2" /></td>
                        <td class="td">{{ $request->requestExportation?->date_quotation }}</td>

                        <td class="td">{{ $request->requestExportation?->date_acceptance }}</td>

                        <td class="td">{{ number_format($request->requestExportation?->initial_flete) }}</td>

                        <td class="items-center justify-center gap-2 td row">
                           @livewire('user.exportation.details-request-live', ['request' => $request->requestExportation], key('detail-request-'.$request->requestExportation->id))

                            @if ($request->requestExportation?->status == 1)
                                @livewire('user.exportation.upload-invoice', ['request' => $request->requestExportation], key('invoice-request-'.$request->requestExportation->id))
                                <button
                                    wire:key="confirm-delevery-{{ $request->requestExportation?->id }}"
                                    class="bg-gray-500 btn-free-color tooltip tooltip-top"
                                    data-tip="Confirmar entrega"
                                >
                                    <x-icons.checked class="size-5 stroke-white" />
                                </button>
                            @elseif ($request->requestExportation?->status == 3)
                                <button
                                    wire:key="updated-invoice-{{ $request->requestExportation?->id }}"
                                    class="bg-gray-500 btn-free-color tooltip tooltip-top"
                                    data-tip="Subir factura"
                                >
                                    <x-icons.message-check class="size-5 stroke-white" />
                                </button>
                                @livewire('user.exportation.confirm-delivery-live', ['request' => $request->requestExportation], key('confirm-request-'.$request->requestExportation->id))
                            @endif

                            @livewire('user.exportation.decline-requests-live', ['request' => $request->requestExportation, 'roleDecline' => 2], key('reject-request-'.$request->requestExportation->id))
                        </td>
                    @elseif ($request->type_request == 'Solicitud termoformado')
                        <td class="td">
                            <x-utils.status status="{{ $request->requestThermoformed?->status }}" />
                        </td>

                        <td class="td"><x-utils.type-request type="3" /></td>

                        <td class="td">{{ $request->requestThermoformed?->date_quotation }}</td>

                        <td class="td">{{ $request->requestThermoformed?->date_acceptance }}</td>

                        <td class="td">{{ number_format($request->requestThermoformed?->initial_flete) }}</td>

                        <td class="items-center justify-center gap-2 td row">
                            @livewire('user.thermoformed.details-request-live', ['request' => $request->requestThermoformed], key('detail-request-thermoformed'.$request->requestThermoformed->id))

                            @if ($request->requestThermoformed?->status == 1)
                                @livewire('user.thermoformed.upload-invoice', ['request' => $request->requestThermoformed], key('invoice-request-thermoformed'.$request->requestThermoformed->id))
                                <button
                                    wire:key="confirm-delevery-{{ $request->requestThermoformed?->id }}"
                                    class="bg-gray-500 btn-free-color tooltip tooltip-top"
                                    data-tip="Confirmar entrega"
                                >
                                    <x-icons.checked class="size-5 stroke-white" />
                                </button>
                            @elseif ($request->requestThermoformed?->status == 3)
                                <button
                                    wire:key="updated-invoice-{{ $request->requestThermoformed?->id }}"
                                    class="bg-gray-500 btn-free-color tooltip tooltip-top"
                                    data-tip="Subir factura"
                                >
                                    <x-icons.message-check class="size-5 stroke-white" />
                                </button>
                                @livewire('user.thermoformed.confirm-delivery-live', ['request' => $request->requestThermoformed], key('confirm-request-thermoformed'.$request->requestThermoformed->id))
                            @endif

                            @livewire('user.thermoformed.decline-requests-live', ['request' => $request->requestThermoformed, 'roleDecline' => 2], key('reject-request-thermoformed'.$request->requestThermoformed->id))
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
