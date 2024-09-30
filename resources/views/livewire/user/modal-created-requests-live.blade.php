<div>
    <button wire:click="showModal" class="btn-black">
        Crear Solicitud
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Solicitud" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <label for="proveedor">{{ __('Elegir proveedor') }}</label>
                    <select wire:model="proveedor"">
                        <option value="">{{ __('Seleccionar Proveedor') }}</option>
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
                    <label for="nombreCliente">{{ __('nombreCliente') }}</label>
                    <div class="flex">
                        <input wire:model.live="nombreCliente" type="text" id="nombreCliente" class="block w-full mt-1 form-input" />
                    </div>
                    @error('nombreCliente')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="direccionCliente">{{ __('direccionCliente') }}</label>
                    <div class="flex">
                        <input wire:model.live="direccionCliente" type="text" id="direccionCliente" class="block w-full mt-1 form-input" />
                    </div>
                    @error('direccionCliente')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="telefonoCliente">{{ __('telefonoCliente') }}</label>
                    <div class="flex">
                        <input wire:model.live="telefonoCliente" type="text" id="telefonoCliente" class="block w-full mt-1 form-input" />
                    </div>
                    @error('telefonoCliente')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="tipoContenedor">{{ __('tipoContenedor') }}</label>
                    <div class="flex">
                        <input wire:model.live="tipoContenedor" type="text" id="tipoContenedor" class="block w-full mt-1 form-input" />
                    </div>
                    @error('tipoContenedor')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="pesoOrden">{{ __('pesoOrden') }}</label>
                    <div class="flex">
                        <input wire:model.live="pesoOrden" type="text" id="pesoOrden" class="block w-full mt-1 form-input" />
                    </div>
                    @error('pesoOrden')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="fechaCita">{{ __('Fecha de la cita') }}</label>
                    <input
                        type="date"
                        wire:model.live="fechaCita"
                        class="block w-full mt-1 form-input"
                    />
                    @error('fechaCita')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="comentario">Comentario</label>
                    <textarea
                        class="block w-full mt-1 form-control"
                        rows="5"
                        wire:model.live="comentario"
                    ></textarea>
                    @error('comentario')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close">
                <p>Cancelar</p>
            </button>
            <button wire:click="store">
                <p>Solicitar</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
