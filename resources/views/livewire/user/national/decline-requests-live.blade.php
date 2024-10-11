<div>
    <button wire:key="show-accept-{{ $request->id }}" wire:click="showModal" class="btn-decline tooltip tooltip-top" data-tip="Rechazar">
        <x-icons.x-mark class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Cancelacion del servicio" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <span class="title-input">Razón por la cual se esta cancelando la solicitud</span>
                    <textarea
                        class="w-full input-simple min-h-[150px]"
                        style="border-radius: 10px"
                        rows="5"
                        wire:model.live="decline_comment"
                    ></textarea>
                    @error('decline_comment')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p>Atras</p>
            </button>

            <button wire:click="store" class="btn-confirm-modal">
                <p>Cancelar servicio</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
