<div>
    <div x-data="{ tab: 0, open: false }" x-cloak class="flex-col w-full py-4 center-content">
        <div class="w-full lg:w-[1024px] col gap-auto">
            <div class="card-indigo-2">
                <div class="justify-between px-4 py-3 row" role="group">
                    <div class="flex">

                        <button
                            class="px-6 py-2 font-bold text-center border rounded-r-2xl border-indigo-1"
                            :class="tab === 1 ? 'bg-indigo-1 font-bold' : ''"
                            type="button"
                            @click="if (tab !== 1) { tab = 1; }" x-on:click="open=true"
                        >
                            {{ __('Export') }}
                        </button>
                    </div>

                    <button @click="open=!open">
                        <i x-show="open" class="text-2xl fa-solid fa-circle-chevron-up text-indigo-1"></i>
                        <i x-show="!open" class="text-2xl fa-solid fa-circle-chevron-down text-indigo-1"></i>
                    </button>
                </div>

                <div x-show="open" class="p-4">
                    <div x-show="tab === 1" x-transition:enter.duration.500ms>
                        <div class="gap-3 divide-y col divide-indigo-2">
                            <div class="gap-2 row">
                                <div class="w-1/2 gap-1 col">
                                    <p class="text-sm italic font-light">{{ __('Date from') }}:</p>
                                    <input class="w-full input-simple placeholder:italic" type="date" wire:model.lazy="start_date"/>
                                    @error('start_date')
                                        <small class="text-sm text-red-500">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="w-1/2 gap-1 col">
                                    <p class="text-sm italic font-light">{{ __('Date until') }}:</p>
                                    <input class="w-full input-simple placeholder:italic" type="date" wire:model.lazy="end_date" />
                                    @error('end_date')
                                        <small class="text-sm text-red-500">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="gap-1 py-2 col">
                                <p class="text-sm italic font-light">{{ __('Filtro Solicitudes') }}:</p>
                                <div class="gap-2 col lg:gap-0 lg:justify-between lg:flex-row">
                                    <label class="flex items-center">
                                        <input
                                            class="mr-2 text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                                            type="checkbox"
                                            value="true"
                                            wire:model.lazy='finalizadas'
                                        >
                                        <span>{{ __('Solicitudes finalizada') }}</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input
                                            class="mr-2 text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                                            type="checkbox"
                                            value="true"
                                            wire:model.lazy='rechazada'
                                        >
                                        <span>{{ __('Solicitudes rechazada') }}</span>
                                    </label>

                                </div>
                            </div>

                            <div class="justify-end gap-2 pt-4 row">
                                <button class="px-6" wire:click="resetAllExport">{{ __('Reset') }}</button>
                                <button class="px-6" wire:click="exportar">
                                    <span wire:loading.remove wire:target="exportar">{{ __('Export') }}</span>
                                    <span wire:loading wire:target="exportar">
                                        <svg
                                            wire:loading
                                            class="w-4 h-4 mr-2 -ml-1 text-white animate-spin"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg> {{ __('Exporting...') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
            @forelse($requests as $request)
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
                        @elseif ($request->status == 3)
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
