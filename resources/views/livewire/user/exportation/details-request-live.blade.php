<div>
    <button
        wire:key="show-accept-{{ $request->id }}"
        wire:click="showModal"
        class="btn-info tooltip tooltip-top"
        data-tip="Más información"
    >
        <x-icons.info class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth='md'>
        <x-slot name="title">
            <div class="items-center col">
                <p class="text-xl font-semibold text-center">Detalles de la solicitud de exportacion</p>
                <x-utils.status status="{{ $request->status }}" />
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <div class="divide-y divide-gray-300 col dark:divide-white/20">
                        @if ($request->status == 3 || $request->status == 4 || $request->status == 5)
                            <div class="py-2 col">
                                <button class="text-base font-semibold" wire:click="downloadInvoice">Descargar Factura</button>
                            </div>
                        @endif

                        @role('User')
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Nombre del proveedor</span>
                                <p class="font-light">{{ $request->provider }}</p>
                            </div>
                        @endrole

                        @if ($request->status != 0)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Cliente</span>
                                <p class="font-light">{{ $request->client_name }}</p>
                            </div>
                        @endif

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Direccion del cliente</span>
                            <p class="font-light">{{ $request->client_address }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Telefono del cliente</span>
                            <p class="font-light">{{ $request->client_phone }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Tipo de vehiculo</span>
                            <p class="font-light">{{ $request->type_vehicle }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Total de peso neto</span>
                            <p class="font-light">{{ number_format($request->total_net_weight) }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Total de peso bruto</span>
                            <p class="font-light">{{ number_format($request->total_gross_weight) }}</p>
                        </div>

                        @if ($request->comment)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Comentario</span>
                                <p class="font-light">{{ $request->comment }}</p>
                            </div>
                        @endif

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Fecha de solicitud</span>
                            <p class="font-light">{{ $request->date_quotation }}</p>
                        </div>

                        @if ($request->status != 0 && $request->status != 1 && $request->status != 2)

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Flete inicial</span>
                                <p class="font-light">{{ number_format($request->initial_flete) }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Tiempo de respuesta</span>
                                <p class="font-light">{{ $request->time_response }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Fecha de aceptacion del pedido</span>
                                <p class="font-light">{{ $request->date_acceptance }}</p>
                            </div>
                        @endif

                        @if ($request->status == 2)
                            @if ($request->decline_comment)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Motivo cancelacion del proveedor</span>
                                    <p class="font-light">{{ $request->decline_comment }}</p>
                                </div>
                            @elseif ($request->decline_comment_user)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Motivo cancelacion del usuario</span>
                                    <p class="font-light">{{ $request->user_decline_comment }}</p>
                                </div>
                            @endif
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Fecha de cancelacion</span>
                                <p class="font-light">{{ $request->date_decline }}</p>
                            </div>
                        @endif

                        @if ($request->status == 4 || $request->status == 5)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Flete final</span>
                                <p class="font-light">{{ number_format($request->final_flete) }}</p>
                            </div>

                            @if ($request->delivery_commentary)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">comentario de entrega</span>
                                    <p class="font-light">{{ $request->delivery_commentary }}</p>
                                </div>
                            @endif
                        @endif

                        @if ($request->status == 5)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Fecha de entrega del pedido</span>
                                <p class="font-light">{{ $request->date_loading }}</p>
                            </div>
                        @endif

                        @if ($request->status != 0 && $request->vehicle_quantity)
                            <div>
                                <button wire:click="activeDetailProforma" class="btn-confirm-modal">
                                    @if ($detailProforma)
                                        <p class="title-input">Ocultar todos los campos de los vehiculos de la proforma</p>
                                    @else
                                        <p class="title-input">Mostrar todos los campos de los vehiculos de la proforma</p>
                                    @endif
                                </button>
                            </div>

                            @if ($detailProforma)
                                @foreach ($providers as $orderItem)
                                    <div class="gap-3 col lg:flex-row lg:gap-5">
                                        <div class="modal-content">
                                            <span class="title-input">Vehículo {{ $loop->iteration }}</span>
                                            <h2>Información de los vehiculos</h2>
                                            <p>Tipo de vehiculo: {{ $orderItem->type_vehicle }}</p>
                                            <p>Peso neto: {{ $orderItem->net_weight }}</p>
                                            <p>Peso bruto: {{ $orderItem->gross_weight }}</p>
                                            <p>Tipo de contenedor: {{ $orderItem->container_type }}</p>
                                            <p>Nombre del conductor: {{ $orderItem->driver_name }}</p>
                                            <p>Telefono del conductor: {{ $orderItem->driver_phone }}</p>
                                            <p>numero de identificacion: {{ $orderItem->identification }}</p>
                                            <p>Matricula del vehiculo: {{ $orderItem->license_plate }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p class="font-light">Atras</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
