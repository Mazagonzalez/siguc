<div>
    <button
        wire:key="show-accept-{{ $request->id }}"
        wire:click="showModal"
        class="btn-confirm tooltip tooltip-top"
        data-tip="Confirmar entrega"
    >
        <x-icons.checked class="size-5 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" title="Confirmar entrega" >
        <x-slot name="content">
            <div class="gap-3 col">
                <div>
                    <span class="title-input">Flete Final</span>
                    <input wire:model.live="final_flete" oninput="formatNumber(this)" type="text" class="w-full input-simple" />
                    @error('final_flete')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <span class="title-input">Fecha la entrega</span>
                    <input
                        type="date"
                        wire:model.live="date_loading"
                        class="w-full input-simple"
                    />
                    @error('date_loading')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- boton pa subir el archivoa azure --}}
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label for="file-upload">
                        <span class="title-input">Subir cumplido  </span>
                        <div
                            class="text-sm col w-full h-[150px] center-content bg-transparent cursor-pointer border-2 border-dashed border-indigo-1 rounded-xl">
                            <div class="w-[60px] center-content h-[48px] fill-white">

                            </div>
                            <span class="mt-3 font-semibold text-indigo-1">Subir Archivo</span>
                            <input wire:model.live="completed" type="file"
                                class="w-[180px] font-light focus:outline-none focus:ring-0 file:text-[0px] file:bg-transparent file:border-none" />
                            @error('completed')
                                <span class="err">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </label>

                    <div x-show="isUploading">
                        <progress max="100" class="w-full progress progress-primary"
                            x-bind:value="progress"></progress>
                    </div>
                </div>

                <div>
                    <span class="title-input">Comentario (opcional)</span>
                    <textarea
                        class="w-full input-simple min-h-[80px]"
                        style="border-radius: 20px"
                        rows="5"
                        wire:model.live="delivery_commentary"
                    ></textarea>
                    @error('delivery_commentary')
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
                <p>Confirmar</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
