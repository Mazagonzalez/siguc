<div>
    <button
        wire:key="show-accept-{{ $request->id }}"
        wire:click="showModal"
        class="btn-confirm tooltip tooltip-top"
        data-tip="Aceptar"
    >
        <x-icons.checked class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Datos para aceptar solicitud" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <span class="title-input">Flete inicial</span>
                    <input wire:model.live="initial_flete" oninput="formatNumber(this)" type="text" class="w-full input-simple" />
                    @error('initial_flete')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    @foreach ($proformas as $index => $proforma)
                        <div class="p-4 mt-4 bg-white rounded-lg shadow-2xl">
                            <div>
                                <span class="title-input">Vehículo {{ $loop->iteration }}</span>
                            </div>
                            <div>
                                <span class="title-input">Placa del vehiculo</span>
                                <input wire:model.live="license_plates.{{ $index }}" type="text" class="w-full uppercase input-simple" />
                                @error('license_plates.' . $index)
                                    <span class="err">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <span class="title-input">Nombre del conductor</span>
                                <input wire:model.live="driver_names.{{ $index }}" type="text" class="w-full input-simple" />
                                @error('driver_names.' . $index)
                                    <span class="err">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <span class="title-input">Identificacion del conductor</span>
                                <input wire:model.live="identifications.{{ $index }}" oninput="validateNumber(this)" type="text" class="w-full input-simple" />
                                @error('identifications.' . $index)
                                    <span class="err">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <span class="title-input">Teléfono del conductor</span>
                                <input wire:model.live="driver_phones.{{ $index }}" oninput="validateNumber(this)" type="text" class="w-full input-simple" />
                                @error('driver_phones.' . $index)
                                    <span class="err">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p>Cancelar</p>
            </button>

            <button wire:click="store" class="btn-confirm-modal">
                <p>Aceptar solicitud</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
