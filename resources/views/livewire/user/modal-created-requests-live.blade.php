<div>
    <button wire:click="showModal" class="btn-black">
        Crear Solicitud
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Solicitud" >
        <x-slot name="content">
            <div class="gap-3 col">
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
                    <input wire:model.live="nombreCliente" type="text" class="w-full input-simple" />
                    @error('nombreCliente')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Dirección del cliente</span>
                    <input wire:model.live="direccionCliente" type="text" class="w-full input-simple" />
                    @error('direccionCliente')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Teléfono</span>
                    <input wire:model.live="telefonoCliente" type="text" class="w-full input-simple" />
                    @error('telefonoCliente')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <select name="tipoContenedor" id="tipoContenedor" class="w-full input-simple" wire:model.live="tipoContenedor">
                        <option value="0">Seleccionar contenedor</option>
                        <option value="1">Contenedor de 40</option>
                        <option value="2">Contenedor de 45</option>
                    </select>
                    @error('tipoContenedor')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Peso de orden</span>
                    <input wire:model.live="pesoOrden" type="text" class="w-full input-simple" />
                    @error('pesoOrden')
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

                <div>
                    <span class="title-input">Comentarios (opcial)</span>
                    <textarea
                        class="w-full input-simple min-h-[140px]"
                        style="border-radius: 10px"
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
            <button wire:click="close" class="btn-close-modal">
                <p>Cancelar</p>
            </button>

            <button wire:click="store" class="btn-acept-modal">
                <p>Solicitar</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
