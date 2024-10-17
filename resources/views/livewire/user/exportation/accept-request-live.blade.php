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
                <div x-data="{ currentSlide: 0, slides: {{ $proformas->count() }} }" class="mt-6">
                    <div class="items-center justify-between mx-6 row">
                        <button class="btn-info" @click="currentSlide = (currentSlide + {{ $proformas->count() - 1 }}) % slides">
                            <x-icons.arrow class="rotate-90 size-5 stroke-white" />
                        </button>

                        <p class="text-lg font-semibold">Vehiculo # <span x-text="currentSlide + 1"></span> / {{ $proformas->count() }} </p>

                        <button class="btn-info" @click="currentSlide = (currentSlide + 1) % slides">
                            <x-icons.arrow class="-rotate-90 size-5 stroke-white" />
                        </button>
                    </div>

                    @foreach ($proformas as $index => $proforma)
                        <div
                            x-transition:enter.duration.500ms
                            x-show="currentSlide === {{ $loop->index }}"
                            class="gap-3 px-5 py-10 mt-4 col rounded-xl bg-gray-50 dark:bg-zinc-800"
                            style="display: none;"
                        >
                            <div>
                                <span class="title-input">Flete inicial vehiculo {{ $loop->index + 1 }}</span>
                                <input wire:model.live="initial_flete.{{ $index }}" oninput="formatNumber(this)" type="text" class="w-full input-simple"/>
                                @error('initial_flete.' . $index)
                                    <span class="err">
                                        {{ $message }}
                                    </span>
                                @enderror
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
                    @error('errFalta')
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
