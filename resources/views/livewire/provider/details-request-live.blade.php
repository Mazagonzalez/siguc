<div>
    <button wire:click="showModal" class="btn-acept-modal" wire:key="show-accept-{{ $request->id }}">
        <x-icons.info class="size-6 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Datos para aceptar solicitud" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Cliente</span>
                    <p>{{ $request->client_name }}</p>
                </div>
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Direccion del Cliente</span>
                    <p>{{ $request->client_address }}</p>
                </div>
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Telefono del cliente</span>
                    <p>{{ $request->client_phone }}</p>
                </div>
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Tipo de contenedor</span>
                    <p>{{ $request->container_type }}</p>
                </div>
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Peso de la solicitud</span>
                    <p>{{ $request->order_weight }}</p>
                </div>
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Fecha de solicitud</span>
                    <p>{{ $request->date_quotation }}</p>
                </div>

                @if ($request->status == 1 || $request->status == 2 || $request->status == 3)
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">Tipo de vehiculo</span>
                        <p>{{ $request->type_vehicle }}</p>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">Placa del vehiculo</span>
                        <p>{{ $request->license_plate }}</p>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">Nombre del conductor</span>
                        <p>{{ $request->driver_name }}</p>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">Identificacion del conductor</span>
                        <p>{{ $request->identification }}</p>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">Fecha de aceptacion del pedido</span>
                        <p>{{ $request->date_acceptance }}</p>
                    </div>
                @endif

                @if ($request->status == 2 || $request->status == 3)
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">Fecha de entrega del pedido</span>
                        <p>{{ $request->date_loading }}</p>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="font-semibold">estado</span>
                        @if ($request->status == 2)
                            <p>Cancelado</p>
                        @elseif ($request->status == 3)
                            <p>Finalizado</p>
                        @endif
                    </div>
                @endif
                <div class="flex items-end justify-between">
                    <span class="font-semibold">Comentario</span>
                    <p>{{ $request->comment }}</p>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p>Cancelar</p>
            </button>

            <button wire:click="store" class="btn-acept-modal">
                <p>Solicitar</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
