<div>
    <button
            class="btn btn-primary"
            wire:click="showModal"
        >
            Crear nueva orden
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" >
        <x-slot name="title">
            <h2 class="text-xl font-semibold">Solicitud</h2>
        </x-slot>
        <x-slot name="content">
            <p>Todos los campos son obligatorios</p>
                <div>
                    <div>
                        <label for="proveedor">{{ __('Elegir proveedor') }}</label>
                        <div class='flex'>
                            <select wire:model="proveedor"">
                                <option value="">{{ __('Seleccionar Proveedor') }}</option>
                                @foreach ($proveedores as $nombre)
                                    <option value="{{ $nombre }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('proveedor')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label for="nombreCliente">{{ __('nombreCliente') }}</label>
                        <div class="flex">
                            <input wire:model="nombreCliente" type="text" id="nombreCliente" class="block w-full mt-1 form-input" />
                        </div>
                        @error('nombreCliente')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                    @enderror
                    </div>

                    <div>
                        <label for="direccionCliente">{{ __('direccionCliente') }}</label>
                        <div class="flex">
                            <input wire:model="direccionCliente" type="text" id="direccionCliente" class="block w-full mt-1 form-input" />
                        </div>
                        @error('direccionCliente')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label for="telefonoCliente">{{ __('telefonoCliente') }}</label>
                        <div class="flex">
                            <input wire:model="telefonoCliente" type="text" id="telefonoCliente" class="block w-full mt-1 form-input" />
                        </div>
                        @error('telefonoCliente')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label for="tipoContenedor">{{ __('tipoContenedor') }}</label>
                        <div class="flex">
                            <input wire:model="tipoContenedor" type="text" id="tipoContenedor" class="block w-full mt-1 form-input" />
                        </div>
                        @error('tipoContenedor')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label for="pesoOrden">{{ __('pesoOrden') }}</label>
                        <div class="flex">
                            <input wire:model="pesoOrden" type="text" id="pesoOrden" class="block w-full mt-1 form-input" />
                        </div>
                        @error('pesoOrden')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label for="fechaCita">{{ __('Fecha de la cita') }}</label>
                        <input
                            type="date"
                            wire:model.lazy="fechaCita"
                            class="block w-full mt-1 form-input"
                        />
                        @error('fechaCita')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label for="comentario">Comentario</label>
                        <textarea
                            class="block w-full mt-1 form-control"
                            rows="5"
                            wire:model.lazy="comentario"
                        ></textarea>
                        @error('comentario')
                            <small class="text-red-600">
                                {{ $message }}
                            </small>
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
