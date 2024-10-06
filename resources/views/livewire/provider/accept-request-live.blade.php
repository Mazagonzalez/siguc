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
                    <span class="title-input">Placa del vehiculo</span>
                    <input wire:model.live="license_plate" type="text" class="w-full uppercase input-simple" />
                    @error('license_plate')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Nombre del conductor</span>
                    <input wire:model.live="driver_name" type="text" class="w-full input-simple" />
                    @error('driver_name')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Identificacion del conductor</span>
                    <input wire:model.live="identification" oninput="validateNumber(this)" type="text" class="w-full input-simple" />
                    @error('identification')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Teléfono del conductor</span>
                    <input wire:model.live="driver_phone" oninput="validateNumber(this)" type="text" class="w-full input-simple" />
                    @error('driver_phone')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Flete inicial</span>
                    <input wire:model.live="initial_flete" oninput="formatNumber(this)" type="text" class="w-full input-simple" />
                    @error('initial_flete')
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
                <p>Aceptar solicitud</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
