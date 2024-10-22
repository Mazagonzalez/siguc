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
                <p class="text-xl font-semibold text-center">Detalles de la solicitud de termoformado</p>
                <div class="items-center gap-2 row">
                    <x-utils.status status="{{ $request->status }}" />

                    @if ($request->status == 3 || $request->status == 4 || $request->status == 5)
                        <button
                            wire:click="downloadInvoice"
                            class="items-center gap-2 px-2 font-semibold text-indigo-500 bg-indigo-100 rounded-full row hover:bg-indigo-200"
                        >
                            Descargar Factura

                            <x-icons.download class="size-4 stroke-indigo-500" />
                        </button>
                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <div class="divide-y divide-gray-300 col dark:divide-white/20">
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
                            <span class="text-base font-semibold">Ciudad</span>
                            <p class="font-light">{{ $request->city }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Tipo de vehiculo</span>
                            <p class="font-light">{{ $request->type_vehicle }}</p>
                        </div>

                        @if ($request->type_vehicle == 'Tractomula')
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Tipo de contenedor</span>
                                <p class="font-light">{{ $request->container_type }}</p>
                            </div>
                        @endif

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Cantidad de cajas</span>
                            <p class="font-light">{{ $request->box_quantity}}</p>
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

                        @if ($request->status != 0 && $request->identification != null)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Placa del vehiculo</span>
                                <p class="font-light">{{ $request->license_plate }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Nombre del conductor</span>
                                <p class="font-light">{{ $request->driver_name }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Telefono del conductor</span>
                                <p class="font-light">{{ $request->driver_phone }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Identificacion del conductor</span>
                                <p class="font-light">{{ $request->identification }}</p>
                            </div>

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
