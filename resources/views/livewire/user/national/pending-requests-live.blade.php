<div>
    {{-- Filtro --}}
    <div x-data="{ showFilter: false }" class="p-4 rounded-lg cursor-pointer bg-zinc-100 dark:bg-[#252525] my-5">
        <div class="items-center justify-between row" @click="showFilter = !showFilter">
            <button class="items-center gap-1 row">
                <span class="text-sm">Filtrar</span>
                <x-icons.arrow class="stroke-black dark:stroke-white size-4" />
            </button>
        </div>

        <div
            x-ref="container"
            class="gap-4 overflow-hidden transition-all duration-300 col max-h-0"
            x-bind:style="showFilter == true ? 'max-height: ' + $refs.container.scrollHeight + 'px' : ''"
        >
            <div class="col">
                <div class="items-end gap-2 px-2 mt-6 row">
                    <div class="w-1/3">
                        <p class="title-input">Fecha inicial:</p>
                        <input class="w-full input-simple" type="date" wire:model.lazy="start_date"/>
                    </div>

                    <div class="w-1/3">
                        <p class="title-input">Fecha final:</p>
                        <input class="w-full input-simple" type="date" wire:model.lazy="end_date" />
                    </div>

                    <div class="w-1/3">
                        <p class="title-input">Estado:</p>
                        <select class="w-full input-simple" wire:model.live="statu">
                            <option value="0">Selecciona</option>
                            <option value="1">Pendiente</option>
                            <option value="2">Aceptado</option>
                        </select>
                    </div>
                </div>
                @error('start_date')
                    <span class="err">
                        {{ $message }}
                    </span>
                @enderror
                @error('end_date')
                    <span class="err">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="justify-end gap-2 px-2 row">
                <button wire:click="resetAllExport" class="items-center gap-2 btn-close-modal row">
                    <x-icons.clear class="stroke-slate-900 dark:stroke-white size-5" />

                    <span>
                        Limpiar
                    </span>
                </button>

                {{-- export por si futuro --}}
                {{-- <button wire:click="exportar" class="items-center gap-2 btn-confirm-modal row">
                    <x-icons.download class="stroke-white size-5" />

                    <span wire:loading.remove wire:target="exportar">
                        Exportar
                    </span>
                    <span wire:loading wire:target="exportar">
                        <x-icons.loading />
                    </span>
                </button> --}}
            </div>
        </div>
    </div>

    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Numero de orden</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th">Tiempo de respuesta</th>
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
                            #1 {{ $request->order_number }} <br>
                            #2 {{ $request->request_double->order_number }}
                        @else
                            @if ($request->order_number)
                                #{{ $request->order_number }}
                            @else
                                Sin numero de orden
                            @endif
                        @endif
                    </td>

                    <td class="td">{{ $request->date_quotation }}</td>

                    <td class="td">
                        @if ($request->status == '0')
                            <p>En espera</p>
                        @else
                            {{ $request->date_acceptance }}
                        @endif

                    </td>

                    <td class="td">
                        @if ($request->status == '0')
                            <p>En espera</p>
                        @else
                            {{ $request->time_response }}
                        @endif
                    </td>

                    <td class="items-center justify-end gap-2 td row">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('user.national.decline-requests-live', ['request' => $request, 'roleDecline' => 1], key('reject-request-'.$request->id))
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <p class="py-20 text-center">No tienes solicitudes en proceso</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>