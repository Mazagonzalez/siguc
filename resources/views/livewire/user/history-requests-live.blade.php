<div>
    <div x-data="{ open: false }" @click.away="open = false">
        <button class="size-[52px] rounded-lg border dark:border-white/20 hover:bg-[#ebecec] dark:hover:bg-[#333333] center-content absolute top-8 right-8" @click="open = !open">
            <x-icons.filter class="stroke-black dark:stroke-white size-6" />
        </button>

        <div
            x-show="open"
            x-keydown.escape="open = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="absolute z-20 -mt-8 bg-white border shadow dark:bg-zinc-900 divide-theme dark:border-none right-4 rounded-2xl"
            style="display: none"
        >
            <div class="items-center justify-between px-4 pt-4 pb-3 row">
                <p class=font-medium">
                    Filtrar
                </p>

                <button wire:click="resetAllExport" class="items-center gap-3 py-2 row tooltip tooltip-top" data-tip="Limpiar filtro">
                    <x-icons.clear class="stroke-black dark:stroke-white size-5" />
                </button>
            </div>


            <div class="px-4 py-3 col gap-1.5">
                <div>
                    <p class="title-input">Fecha inicial:</p>
                    <input class="w-full input-simple" type="date" wire:model.lazy="start_date"/>
                    @error('start_date')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <p class="title-input">Fecha final:</p>
                    <input class="w-full input-simple" type="date" wire:model.lazy="end_date" />
                    @error('end_date')
                        <span class="err">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="px-4 py-3 col gap-1.5">
                <label class="flex items-center">
                    <input
                        class="input-check"
                        type="checkbox"
                        value="true"
                        wire:model.lazy='finalizadas'
                    >
                    <span>Finalizados</span>
                </label>

                <label class="flex items-center">
                    <input
                        class="input-check"
                        type="checkbox"
                        value="true"
                        wire:model.lazy='rechazada'
                    >
                    <span>Rechazados</span>
                </label>
            </div>

            <div class="px-2 py-3 col">
                <button class="w-full px-2 py-2 rounded-xl hover:bg-[#ebecec] dark:hover:bg-[#333333] flex items-center justify-start gap-2" wire:click="exportar">
                    <x-icons.download class="stroke-slate-900 dark:stroke-white size-5" />

                    <span wire:loading.remove wire:target="exportar">
                        Descargar
                    </span>
                    <span wire:loading wire:target="exportar">
                        <x-icons.loading />
                    </span>
                </button>
            </div>
        </div>
    </div>

    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Numero de orden</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de finalizacion</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requestsCollection as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <x-utils.status status="{{ $request->status }}" />
                    </td>

                    <td class="td">
                        @if ($request->id_request_double)
                            Order #1 {{ $request->order_number }} <br>
                            Order #2 {{ $request->request_double->order_number }}
                        @else
                            Order #1 {{ $request->order_number }}
                        @endif
                    </td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">
                        @if ($request->status == 2)
                            {{ $request->date_decline }}
                        @elseif ($request->status == 4)
                            {{ $request->date_loading }}
                        @endif
                    </td>

                    <td class="flex justify-center td">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <p class="py-20 text-center">No tiene historial de solicitudes finalizada</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
