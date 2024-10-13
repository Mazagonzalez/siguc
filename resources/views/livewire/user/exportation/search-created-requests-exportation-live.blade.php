<div>
    <button wire:click="showModal" class="btn-info tooltip tooltip-top" data-tip="Crear Solicitud">
        <x-icons.more class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="4xl" title="Solicitud de exportaecion (Proforma)" >
        <x-slot name="content">
            <div class="gap-3 col lg:flex-row lg:gap-5">
                <div class="gap-3 col lg:w-1/2">
                    <div>
                        <span class="title-input">Proveedor</span>
                        <select wire:model.live="provider" class="input-simple max-w-[400px]">
                            <option value="">Seleccionar Proveedor</option>
                            @foreach ($providers as $nombre)
                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                        @error('provider')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Nombre del cliente</span>
                        <input wire:model.live="client_name" type="text" class="w-full input-simple" readonly/>
                        @error('client_name')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Dirección del cliente (Editable)</span>
                        <input wire:model.live="client_address" type="text" class="w-full input-simple"/>
                        @error('client_address')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Teléfono</span>
                        <input wire:model.live="client_phone" oninput="validateNumber(this)" type="text" class="w-full input-simple" />
                        @error('client_phone')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Tipo de vehiculo</span>
                        <input wire:model.live="type_vehicle" type="text" class="w-full input-simple" readonly/>
                        @error('type_vehicle')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Total peso neto</span>
                        <input wire:model.live="total_net_weight" type="text" class="w-full input-simple" readonly />
                        @error('total_net_weight')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Total peso bruto</span>
                        <input wire:model.live="total_gross_weight" type="text" class="w-full input-simple" readonly />
                        @error('total_gross_weight')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Total de vehiculos requerido</span>
                        <input wire:model.live="vehicle_quantity" type="text" class="w-full input-simple"/>
                        @error('vehicle_quantity')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Fecha de la cita</span>
                        <input
                            type="date"
                            wire:model.live="date_quotation"
                            class="w-full input-simple"
                        />
                        @error('date_quotation')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="gap-3 col lg:w-1/2">
                    <div class="px-5 py-2 text-center bg-gray-100 dark:bg-zinc-800 rounded-xl">
                        <p class="font-light"><span class="font-semibold">Nota:</span> Los siguientes campos son opcionales</p>
                    </div>

                    <div>
                        <span class="title-input">Comentarios</span>
                        <textarea
                            class="w-full input-simple min-h-[80px]"
                            style="border-radius: 20px"
                            rows="5"
                            wire:model.live="comment"
                        ></textarea>
                        @error('comment')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <button wire:click="activeDetailProforma" class="btn-confirm-modal">
                            @if ($detailProforma)
                                <p class="title-input">Ocultar todas las ordenes de la proforma</p>
                            @else
                                <p class="title-input">Mostrar todas las ordenes de la proforma</p>
                            @endif
                        </button>
                    </div>

                    @if ($detailProforma)
                        @foreach ($order['orders'] as $orderItem)
                            <div class="gap-3 col lg:flex-row lg:gap-5">
                                <div class="modal-content">
                                    <h2>Información de la Orden</h2>
                                    <p>Cliente: {{ $orderItem['target_customer'] }}</p>
                                    <p>Dirección del Cliente: {{ $orderItem['client_address'] }}</p>
                                    <p>Peso Neto: {{ $orderItem['net_weight'] }}</p>
                                    <p>Peso Bruto: {{ $orderItem['gross_weight'] }}</p>
                                    <p>Tipo de contenedor: {{ $orderItem['unit_load'] }}</p>
                                    <p>Estado: {{ $orderItem['statu'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p>Cancelar</p>
            </button>

            <button wire:click="store" class="btn-confirm-modal">
                <p>Crear solicitud</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>

