<div>
    <button
        wire:key="show-accept-{{ $request->id }}"
        wire:click="showModal"
        class="btn-info tooltip tooltip-top"
        data-tip="Más información"
    >
        <x-icons.info class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="{{ $request->id_request_double ? '4xl' : 'md' }}" >
        <x-slot name="title">
            <div class="items-center col">
                <p class="text-xl font-semibold text-center">Detalles de la solicitud</p>
                <x-utils.status status="{{ $request->status }}" />
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="col gap-3 {{ $request->id_request_double ? 'lg:gap-5 lg:flex-row' : '' }}">
                {{-- Primera Solicitud --}}
                <div class="{{ $request->id_request_double ? 'lg:w-1/2 col gap-5 p-4 rounded-3xl bg-gray-100 dark:bg-zinc-800' : '' }}">
                    @if ($request->id_request_double)
                        <p class="text-base font-semibold text-center">Detalles de la primera solicitud</p>
                    @endif

                    <div class="divide-y divide-gray-300 col dark:divide-white/20">
                        @role('user')
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Numero de orden</span>
                                <p class="font-light">{{ $request->order_number }}</p>
                            </div>
                        @endrole

                        @if ($request->status != 0)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Cliente</span>
                                <p class="font-light">{{ $request->client_name }}</p>
                            </div>
                        @endif

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Direccion del Cliente</span>
                            <p class="font-light">{{ $request->client_address }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Tipo de contenedor</span>
                            <p class="font-light">{{ $request->container_type }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Peso neto de la solictud</span>
                            <p class="font-light">{{ $request->order_weight }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Peso bruto de la solictud</span>
                            <p class="font-light">{{ $request->gross_weight }}</p>
                        </div>

                        <div class="py-2 col">
                            <span class="text-base font-semibold">Fecha de solicitud</span>
                            <p class="font-light">{{ $request->date_quotation }}</p>
                        </div>

                        @if ($request->status != 0 && $request->type_vehicle != null)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Tipo de vehiculo</span>
                                <p class="font-light">{{ $request->type_vehicle }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Placa del vehiculo</span>
                                <p class="font-light">{{ $request->license_plate }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Nombre del conductor</span>
                                <p class="font-light">{{ $request->driver_name }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Identificacion del conductor</span>
                                <p class="font-light">{{ $request->identification }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Fecha de aceptacion del pedido</span>
                                <p class="font-light">{{ $request->date_acceptance }}</p>
                            </div>
                        @endif

                        @if ($request->status == 3)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Fecha de entrega del pedido</span>
                                <p class="font-light">{{ $request->date_loading }}</p>
                            </div>
                        @endif

                        @if ($request->comment)
                            <div class="py-2 col">
                                <span class="text-base font-semibold">Comentario</span>
                                <p class="font-light">{{ $request->comment }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Segunda Solicitud --}}
                @if ($request->id_request_double)
                    <div class="gap-5 p-4 bg-gray-100 lg:w-1/2 col rounded-3xl dark:bg-zinc-800">
                        <p class="text-base font-semibold text-center">Detalles de la segunda solicitud</p>

                        <div class="divide-y divide-gray-300 col dark:divide-white/20">
                            @if ($request->request_double?->status != 0)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Cliente</span>
                                    <p class="font-light">{{ $request->request_double?->client_name }}</p>
                                </div>
                            @endif

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Direccion del Cliente</span>
                                <p class="font-light">{{ $request->request_double?->client_address }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Tipo de contenedor</span>
                                <p class="font-light">{{ $request->request_double?->container_type }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Peso neto de la solictud</span>
                                <p class="font-light">{{ $request->request_double?->order_weight }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Peso bruto de la solictud</span>
                                <p class="font-light">{{ $request->request_Double?->gross_weight }}</p>
                            </div>

                            <div class="py-2 col">
                                <span class="text-base font-semibold">Fecha de solicitud</span>
                                <p class="font-light">{{ $request->request_double?->date_quotation }}</p>
                            </div>

                            @if ($request->request_double?->status != 0 && $request->request_double?->type_vehicle != null)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Tipo de vehiculo</span>
                                    <p class="font-light">{{ $request->request_double?->type_vehicle }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Placa del vehiculo</span>
                                    <p class="font-light">{{ $request->request_double?->license_plate }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Nombre del conductor</span>
                                    <p class="font-light">{{ $request->request_double?->driver_name }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Identificacion del conductor</span>
                                    <p class="font-light">{{ $request->request_double?->identification }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Fecha de aceptacion del pedido</span>
                                    <p class="font-light">{{ $request->request_double?->date_acceptance }}</p>
                                </div>
                            @endif

                            @if ($request->request_double?->status == 3)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Fecha de entrega del pedido</span>
                                    <p class="font-light">{{ $request->request_double?->date_loading }}</p>
                                </div>
                            @endif

                            @if ($request->request_double?->comment)
                                <div class="py-2 col">
                                    <span class="text-base font-semibold">Comentario</span>
                                    <p class="font-light">{{ $request->request_double?->comment }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p class="font-light">Atras</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
