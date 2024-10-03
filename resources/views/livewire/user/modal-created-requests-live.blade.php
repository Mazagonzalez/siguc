<div>
    <button wire:click="showModal" class="btn-info tooltip tooltip-top" data-tip="Crear Solicitud">
        <x-icons.more class="size-6 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="4xl" title="Solicitud" >
        <x-slot name="content">
            <div class="gap-3 col lg:flex-row lg:gap-5">
                <div class="gap-3 col lg:w-1/2">
                    <div>
                        <select wire:model.live="proveedor" class="input-simple max-w-[400px]">
                            <option value="">Seleccionar Proveedor</option>
                            @foreach ($proveedores as $nombre)
                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                        @error('proveedor')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Nombre del cliente</span>
                        <input wire:model.live="nombreCliente" type="text" class="w-full input-simple" readonly/>
                        @error('nombreCliente')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Dirección del cliente</span>
                        <input wire:model.live="direccionCliente" type="text" class="w-full input-simple" readonly />
                        @error('direccionCliente')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Teléfono</span>
                        <input wire:model.live="telefonoCliente" oninput="validateNumber(this)" type="text" class="w-full input-simple" />
                        @error('telefonoCliente')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Tipo contenedor</span>
                        <input wire:model.live="tipoContenedor" type="text" class="w-full input-simple" readonly />
                        @error('tipoContenedor')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Peso neto</span>
                        <input wire:model.live="pesoOrden" type="text" class="w-full input-simple" readonly />
                        @error('pesoOrden')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Peso bruto</span>
                        <input wire:model.live="gross_weight" type="text" class="w-full input-simple" readonly />
                        @error('gross_weight')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Fecha de la cita</span>
                        <input
                            type="date"
                            wire:model.live="fechaCita"
                            class="w-full input-simple"
                        />
                        @error('fechaCita')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="gap-3 col lg:w-1/2">
                    <div class="px-5 py-2 text-center text-blue-500 bg-blue-50 rounded-xl">
                        <p class="font-light"><span class="font-semibold">Nota:</span> Los siguientes campos son opcionales</p>
                    </div>

                    <div>
                        <span class="title-input">Flete</span>
                        <input wire:model.live="flete" oninput="formatNumber(this)" type="text" class="w-full input-simple" />
                        @error('flete')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Comentarios</span>
                        <textarea
                            class="w-full input-simple min-h-[80px]"
                            style="border-radius: 20px"
                            rows="5"
                            wire:model.live="comentario"
                        ></textarea>
                        @error('comentario')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">Segunda Orden</span>
                        <input wire:model.live="searchOrderId" type="text" class="w-full input-simple" />
                        @error('searchOrderId')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        @if ($orderSecond)
                            @livewire('user.details-second-order-live', [
                                'order_number' => $orderNumber2['order_number'],
                                'target_customer' => $orderNumber2['target_customer'],
                                'client_address' => $orderNumber2['client_address'],
                                'unit_load' => $orderNumber2['unit_load'],
                                'net_weight' => $orderNumber2['net_weight'],
                                'gross_weight' => $orderNumber2['gross_weight'],
                            ], key($orderNumber2['order_number'] . 'request'))
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p>Cancelar</p>
            </button>

            <button wire:click="store" class="btn-confirm-modal">
                <p>Solicitar</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
