<div class="gap-5 screen-default col">
    <div class="gap-4 col lg:flex-row">
        <div class="grid w-[60%] grid-cols-4 gap-4">
            <div class="items-center gap-3 py-10 col rounded-3xl card-theme">
                <div class="bg-blue-500 rounded-md size-12 center-content">
                    <x-icons.message-check class="stroke-white size-8" />
                </div>
                <p class="font-semibold text-sm text-center leading-[18px]">Solictudes <br> Aceptadas</p>
                <p class="text-xl font-semibold">{{ $request_acepted }}</p>
            </div>

            <div class="items-center gap-3 py-10 col rounded-3xl card-theme">
                <div class="bg-yellow-400 rounded-md size-12 center-content">
                    <x-icons.clock class="stroke-white size-8" />
                </div>
                <p class="font-semibold text-sm text-center leading-[18px]">Solictudes <br> Pendientes</p>
                <p class="text-xl font-semibold">{{ $request_pending }}</p>
            </div>

            <div class="items-center gap-3 py-10 col rounded-3xl card-theme">
                <div class="bg-red-500 rounded-md size-12 center-content">
                    <x-icons.message-cancel class="stroke-white size-8" />
                </div>
                <p class="font-semibold text-sm text-center leading-[18px]">Solictudes <br> Rechazadas</p>
                <p class="text-xl font-semibold">{{ $request_rejected }}</p>
            </div>

            <div class="items-center gap-3 py-10 col rounded-3xl card-theme">
                <div class="rounded-md bg-emerald-500 size-12 center-content">
                    <x-icons.check-circle class="stroke-white size-8" />
                </div>
                <p class="font-semibold text-sm text-center leading-[18px]">Solictudes <br> Finalizadas</p>
                <p class="text-xl font-semibold">{{ $request_finished }}</p>
            </div>
        </div>

        <div class="w-[40%] py-4 px-6 card-theme col gap-4">
            <div class="relative">
                <input
                    type="text"
                    wire:model.live="orderId"
                    placeholder="Buscar por numero de orden"
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
                    class="bg-black rounded-full size-9 center-content absolute-center-y right-1.5 tooltip tooltip-top"
                    data-tip="Limpiar buscador"
                >
                    <x-icons.clear class="stroke-white size-5" />
                </button>
            </div>

            <div class="h-full p-4 bg-gray-100 col rounded-3xl dark:bg-zinc-800">
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
                                @livewire('user.modal-created-requests-live', [
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
                        <x-utils.not-search message="No se ha encontrado en la base de datos" />
                    @elseif ($pending === 2)
                        <x-utils.not-search message="Ya se creo esta orden" />
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div
        x-data="{
            typeRequest: 1,
            activeClass: 'bg-[#ebecec] dark:bg-[#333333] font-semibold',
            inactiveClass: '',
            showFilter: false,
        }" class="gap-5 p-8 col card-theme"
    >
        <div class="items-center mb-5 row">
            <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 1" :class="typeRequest === 1 ? activeClass : inactiveClass">
                {{ __('Solicitudes en Proceso')}}
            </a>
            <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 2" :class="typeRequest === 2 ? activeClass : inactiveClass">
                {{ __('Historial de Solicitudes')}}
            </a>
        </div>

        <div class="w-full">
            <div x-show="typeRequest === 1" x-transition:enter.duration.500ms style="display: none">
                @livewire('user.pending-requests-live', key('pending-request-'.auth()->user()->id))
            </div>

            <div x-show="typeRequest === 2" x-transition:enter.duration.500ms style="display: none">
                @livewire('user.history-requests-live', key('history-request-'.auth()->user()->id))
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
