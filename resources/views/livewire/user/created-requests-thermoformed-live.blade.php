<div>
    <button wire:click="showModal" class="text-sm btn-confirm-modal">
        <span>Crear solicitud</span>
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Solicitudes termoformado" >
        <x-slot name="content">
            <div class="gap-3 col">
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
                    <input wire:model.live="client_name" type="text" class="w-full input-simple"/>
                    @error('client_name')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Dirección del cliente</span>
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
                    <span class="title-input">Ciudad</span>
                    <select name="city" id="city" class="w-full input-simple" wire:model.live="city">
                        <option value="0">Seleccionar la ciudad</option>
                        <option value="Barranquilla">Barranquilla</option>
                        <option value="Cali">Cali</option>
                        <option value="Bogota">Bogota</option>
                    </select>
                    @error('city')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Tipo de vehiculo</span>
                    <select name="type_vehicle" id="type_vehicle" class="w-full input-simple" wire:model.live="type_vehicle">
                        <option value="0">Seleccionar tipo de vehiculo</option>
                        <option value="Minimula">Minimula</option>
                        <option value="Camion">Camion</option>
                        <option value="Tractomula">Tractomula</option>
                    </select>
                    @error('type_vehicle')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                @if ($type_vehicle == 'Tractomula')
                    <div>
                        <select name="container_type" id="container_type" class="w-full input-simple" wire:model.live="container_type">
                            <option value="0">Seleccionar tipo de contenedor</option>
                            <option value="Contenedor de 40">Contenedor de 40</option>
                            <option value="Contenedor de 45">Contenedor de 45</option>=
                        </select>
                        @error('container_type')
                            <span class="err">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                @endif

                <div>
                    <span class="title-input">Cantidad de cajas</span>
                    <input wire:model.live="box_quantity" oninput="validateNumber(this)" class="w-full input-simple"/>
                    @error('box_quantity')
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
