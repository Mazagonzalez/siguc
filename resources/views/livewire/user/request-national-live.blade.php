<div class="gap-5 screen-default col">
    <div class="gap-3 row">
        <div class="w-[65%] gap-3 col">
            <div class="gap-4 col lg:flex-row">
                <div class="w-[40%] py-4 px-6 card-theme col gap-4">
                    <div class="relative">
                        <input
                            type="text"
                            wire:model.live="orderId"
                            placeholder="Buscar por numero de orden nacional"
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
                            class="bg-zinc-900 dark:bg-white rounded-xl size-9 center-content absolute-center-y right-1 tooltip tooltip-top"
                            data-tip="Limpiar buscador"
                        >
                            <x-icons.clear class="stroke-white dark:stroke-zinc-900 size-5" />
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
            <div>
                @livewire('user.created-requests-national-live', key('request-national'))
            </div>
        </div>
    </div>
</div>
