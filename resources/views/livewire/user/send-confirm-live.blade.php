<div>
    <button
        wire:key="show-send-{{ $request->id }}"
        wire:click="showModal"
        class="bg-sky-500 btn-free-color hover:bg-sky-600 tooltip tooltip-top"
        data-tip="Enviar correo"
    >
        <x-icons.send-mail class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Enviar correo al cliente" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <span class="title-input">Correo del cliente</span>
                    <input wire:model.live="mail" type="email" class="w-full input-simple" />
                    @error('mail')
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
                <p>Aceptar solicitud</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
