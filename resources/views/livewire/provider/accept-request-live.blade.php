<div>
    <button wire:key="show-accept-{{ $request->id }}" wire:click="showModal" class="btn-acept tooltip tooltip-top" data-tip="Aceptar">
        <x-icons.checked class="size-6 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Datos para aceptar solicitud" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <select name="type_vehicle" id="type_vehicle" class="w-full input-simple" wire:model.live="type_vehicle">
                        <option value="0">Seleccionar tipo de vehiculo</option>
                        <option value="Camion">Camion</option>
                        <option value="Turbo">Turbo</option>
                        <option value="Tractomula">Tractomula</option>
                    </select>
                    @error('type_vehicle')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Placa del vehiculo</span>
                    <input wire:model.live="license_plate" type="text" class="w-full input-simple" />
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
                    <input wire:model.live="identification" type="text" class="w-full input-simple" />
                    @error('identification')
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

            <button wire:click="store" class="btn-acept-modal">
                <p>Aceptar solicitud</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
