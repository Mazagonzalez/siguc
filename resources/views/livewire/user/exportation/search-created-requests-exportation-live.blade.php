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
                        <input wire:model.live="order_quantity" type="text" class="w-full input-simple" readonly />
                        @error('order_quantity')
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
                    <div>
                        <span class="title-input">Documento bocking</span>
                        <input type="file" class="w-full rounded-lg file-input file-input-bordered dark:text-white dark:bg-[#333333] file-input-sm" wire:model='bocking'/>
                        @error('bocking')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div>
                        <span class="title-input">documento carta de retiro (opcional)</span>
                        <input type="file" class="w-full rounded-lg file-input file-input-bordered dark:text-white dark:bg-[#333333] file-input-sm" wire:model='letterWithdrawal'/>
                        @error('letterWithdrawal')
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
                            wire:model.live="comment"
                        ></textarea>
                        @error('comment')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div x-data="{ currentSlide: 0, slides: {{ count($order['orders']) }} }">
                        <div class="items-center mx-6 my-2 row {{ count($order['orders']) > 1 ? 'justify-between' : 'justify-center' }}">
                            @if (count($order['orders']) > 1)
                                <button class="btn-info" @click="currentSlide = (currentSlide + {{ count($order['orders']) - 1 }}) % slides">
                                    <x-icons.arrow class="rotate-90 size-5 stroke-white" />
                                </button>
                            @endif

                            <p class="font-semibold">Orden # <span x-text="currentSlide + 1"></span> </p>

                            @if (count($order['orders']) > 1)
                                <button class="btn-info" @click="currentSlide = (currentSlide + 1) % slides">
                                    <x-icons.arrow class="-rotate-90 size-5 stroke-white" />
                                </button>
                            @endif
                        </div>

                        @foreach ($order['orders'] as $orderItem)
                            <div
                                x-transition:enter.duration.500ms
                                x-show="currentSlide === {{ $loop->index }}"
                                class="p-5 text-sm bg-gray-100 col rounded-3xl dark:bg-zinc-800"
                            >
                                <div class="py-2 col">
                                    <span class="font-semibold">Información de la Orden</span>
                                    <p class="font-light">{{ $orderItem['target_customer'] }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="font-semibold">Dirección del Cliente</span>
                                    <p class="font-light">{{ $orderItem['client_address'] }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="font-semibold">Peso Neto</span>
                                    <p class="font-light">{{ $orderItem['net_weight'] }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="font-semibold">Peso Bruto</span>
                                    <p class="font-light">{{ $orderItem['gross_weight'] }}</p>
                                </div>

                                <div class="py-2 col">
                                    <span class="font-semibold">Tipo de contenedor</span>
                                    <p class="font-light">{{ $orderItem['unit_load'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
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

