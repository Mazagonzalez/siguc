<div class="gap-3 screen-default row">
    <div class="w-1/3 gap-3 p-4 card-theme col h-fit">
        <div class="gap-2 row">
            <input
                type="text"
                wire:model.live="orderId"
                placeholder="Orden nacional"
                class="w-full
                @if ($orders)
                    input-simple-success
                @else
                    @if ($pending === 1 || $pending === 2)
                        input-simple-err
                    @else
                        input-simple
                    @endif
                @endif"
            >

            <button
                wire:click='clear'
                class="px-5 py-2 bg-slate-900 rounded-xl tooltip tooltip-top"
                data-tip="Limpiar buscador"
            >
                <x-icons.clear class="stroke-white size-5" />
            </button>
        </div>

        <div class="p-4 bg-gray-100 col rounded-xl dark:bg-zinc-800 h-[117px]">
            @if ($orders)
                <div wire:key='orden-{{ $orders['id'] }}' class="w-full text-sm">
                    <div class="py-2 font-semibold border-b border-gray-300 row dark:border-white/20">
                        <p class="w-[20%]"># Orden</p>
                        <p>Cliente</p>
                    </div>
                    <div class="items-center py-2 font-light row">
                        <p class="w-[20%]"># {{ $orders['order_number'] }}</p>
                        <p class="tooltip tooltip-top text-start w-[70%]" data-tip="{{ $orders['target_customer'] }}">
                            {{ auth()->user()->short($orders['target_customer'], 25) }}
                        </p>
                        <div class="w">
                            @livewire('user.national.search-created-requests-live', [
                                'targetCustomer' => $orders['target_customer'],
                                'netWeight' => $orders['net_weight'],
                                'grossWeight' => $orders['gross_weight'],
                                'clientAddress' => $orders['client_address'],
                                'unitLoad' => $orders['unit_load'],
                                'orderNumber' => $orders['order_number'],
                            ], key($orders['id'] . 'request'))
                        </div>
                    </div>
                </div>
            @else
                @if ($pending === 0)
                    <x-utils.not-search message="Aun no se ha buscado ninguna orden" />
                @elseif ($pending === 1)
                    <x-utils.not-search message="Esta orden no existe" />
                @elseif ($pending === 2)
                    <x-utils.not-search message="Esta orden ya existe" />
                @endif
            @endif
        </div>

        <div class="relative col">
            @livewire('user.created-requests-national-live', key('request-national'))
        </div>
    </div>

    <div>
        <div
            x-data="{
                typeRequest: 1,
                activeClass: 'bg-[#ebecec] dark:bg-[#333333] font-semibold',
                inactiveClass: '',
                showFilter: false,
            }" class="relative p-8 col card-theme"
        >
            <div class="items-center justify-between row">
                <div class="items-center row">
                    <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 1" :class="typeRequest === 1 ? activeClass : inactiveClass">
                        {{ __('Solicitudes en Proceso')}}
                    </a>
                    <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 2" :class="typeRequest === 2 ? activeClass : inactiveClass">
                        {{ __('Solicitudes por confirmar entrega')}}
                    </a>
                    <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 3" :class="typeRequest === 3 ? activeClass : inactiveClass">
                        {{ __('Historial de Solicitudes')}}
                    </a>
                </div>
            </div>

            <div class="w-full">
                <div x-show="typeRequest === 1" x-transition:enter.duration.500ms style="display: none">
                    @livewire('user.national.pending-requests-live', key('pending-request-'.auth()->user()->id))
                </div>

                <div x-show="typeRequest === 2" x-transition:enter.duration.500ms style="display: none">
                    @livewire('user.national.end-requests-live', key('history-request-'.auth()->user()->id))
                </div>

                <div x-show="typeRequest === 3" x-transition:enter.duration.500ms style="display: none">
                    @livewire('user.national.history-requests-live', key('history-request-'.auth()->user()->id))
                </div>
            </div>
        </div>
    </div>

    @if (session('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:leave.duration.400ms
            wire:transition
            class="fixed z-40 items-center gap-3 px-4 py-2 text-sm font-light text-white rounded-lg bg-emerald-500 row bottom-4 right-4"
        >
            <x-icons.checked class="stroke-white size-5" />

            {{ session('message') }}
        </div>
    @endif
</div>
