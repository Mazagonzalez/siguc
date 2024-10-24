<div class="col">
    {{-- filtro --}}
    <div x-data="{ showFilter: false }" class="p-4 rounded-lg cursor-pointer bg-zinc-100 dark:bg-[#252525] {{ $dashboard == false ? 'my-5' : 'mb-5' }}">
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
                    <div class="w-1/4">
                        <p class="title-input">Fecha inicial:</p>
                        <input class="w-full input-simple" type="date" wire:model.lazy="start_date"/>
                    </div>

                    <div class="w-1/4">
                        <p class="title-input">Fecha final:</p>
                        <input class="w-full input-simple" type="date" wire:model.lazy="end_date" />
                    </div>

                    <div class="w-1/4">
                        <p class="title-input">Estado</p>
                        <select class="w-full input-simple" wire:model.live="statu">
                            <option value="0">Selecciona</option>
                            <option value="1">Finalizado</option>
                            <option value="2">Rechazada</option>
                        </select>
                    </div>

                    <div class="w-1/4">
                        <p class="title-input">Tipo de solicitud</p>
                        <select class="w-full input-simple" wire:model.live="type">
                            <option value="0">Selecciona</option>
                            <option value="1">Nacional</option>
                            <option value="2">Exportacion</option>
                            <option value="3">Termoformado</option>
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

                <button wire:click="exportar" class="items-center gap-2 btn-confirm-modal row">
                    <x-icons.download class="stroke-white size-5" />

                    <span wire:loading.remove wire:target="exportar">
                        Exportar
                    </span>
                    <span wire:loading wire:target="exportar">
                        <x-icons.loading />
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div class="min-h-[342px]">
        <table class="w-full">
            <thead>
                <tr class="tr">
                    <th class="th">#</th>
                    <th class="th">Estado</th>
                    <th class="th">Tipo de orden</th>
                    <th class="th">Fecha de finalizacion / cancelacion</th>
                    <th class="th"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($requestsCollection as $request)
                    <tr wire:key='orden-{{ $request->id }}' class="tr">
                        <td class="font-semibold td">{{ $i++ }}</td>

                        @if ($request->type_request == 'Solicitud nacional')
                            <td class="td">
                                <x-utils.status status="{{ $request->requestNational->status }}" />
                            </td>

                            <td class="td"><x-utils.type-request type="1" /></td>

                            <td class="td">
                                @if ($request->requestNational->status == 2)
                                    {{ $request->requestNational->date_decline }}
                                @elseif ($request->requestNational->status == 5)
                                    {{ $request->requestNational->date_loading }}
                                @endif
                            </td>

                            <td class="flex justify-center td">
                                @livewire('provider.details-request-live', ['request' => $request->requestNational], key('detail-request-'.$request->id))
                            </td>
                        @elseif ($request->type_request == 'Solicitud exportacion')
                            <td class="td">
                                <x-utils.status status="{{ $request->requestExportation->status }}" />
                            </td>

                            <td class="td"><x-utils.type-request type="2" /></td>

                            <td class="td">
                                @if ($request->requestExportation->status == 2)
                                    {{ $request->requestExportation->date_decline }}
                                @elseif ($request->requestExportation->status == 5)
                                    {{ $request->requestExportation->date_loading }}
                                @endif
                            </td>

                            <td class="items-center justify-end gap-2 td row">
                                @livewire('user.exportation.details-request-live', ['request' => $request->requestExportation], key('detail-request-'.$request->id))
                            </td>
                        @elseif ($request->type_request == 'Solicitud termoformado')
                            <td class="td">
                                <x-utils.status status="{{ $request->requestThermoformed->status }}" />
                            </td>

                            <td class="td"><x-utils.type-request type="3" /></td>

                            <td class="td">
                                @if ($request->requestThermoformed->status == 2)
                                    {{ $request->requestThermoformed->date_decline }}
                                @elseif ($request->requestThermoformed->status == 5)
                                    {{ $request->requestThermoformed->date_loading }}
                                @endif
                            </td>

                            <td class="items-center justify-end gap-2 td row">
                                @livewire('user.thermoformed.details-request-live', ['request' => $request->requestThermoformed], key('detail-request-'.$request->id))
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <x-utils.not-search message="No hay solicitudes finalizadas" colspan="5" py="py-24" />
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="paginate">
        {{ $requestsCollection->links('components.utils.paginate') }}
    </div>
</div>
