<div>
    <button
        wire:key="show-accept-{{ $request->id }}"
        wire:click="showModal"
        class="btn-info tooltip tooltip-top"
        data-tip="Más información"
    >
        <x-icons.info class="size-6 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" >
        <x-slot name="title">
            <div class="items-center col">
                <p class="text-xl font-semibold text-center">Detalles de la solicitud</p>
                <x-utils.status status="{{ $request->status }}" />
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-300 col dark:divide-zinc-800">
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

                @if ($request->status != 0)
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

                @if ($request->status == 2 || $request->status == 3)
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
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p class="font-light">Atras</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
