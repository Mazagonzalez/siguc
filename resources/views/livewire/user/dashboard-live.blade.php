<div class="gap-5 screen-default col">
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

    <div class="w-full p-8 card-theme">
        <div class="items-center gap-2 mb-6 row">
            <input
                type="text"
                wire:model.live="orderId"
                placeholder="Buscar por numero de orden"
                class="input-simple w-[300px]"
            >
        </div>

        <table class="w-full">
            <thead>
                <tr class="tr">
                    <th class="th" style="text-align: start">Cliente</th>
                    <th class="th">Orden</th>
                    <th class="th">Peso Total</th>
                    <th class="th">Peso Bruto</th>
                    <th class="th">Dirección</th>
                    <th class="th">Contenedor</th>
                    <th class="th"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr wire:key='orden-{{ $order['id'] }}' class="tr">
                        <td class="td" style="text-align: start">
                            <p class="tooltip tooltip-top" data-tip="{{ $order['target_customer'] }}">
                                {{ auth()->user()->short($order['target_customer'], 20) }}
                            </p>
                        </td>

                        <td class="td">{{ $order['order_number'] }}</td>
                        <td class="td">{{ $order['net_weight'] }} kg</td>
                        <td class="td">{{ $order['gross_weight'] }} kg</td>

                        <td class="td">
                            <p class="tooltip tooltip-top" data-tip="{{ $order['client_address'] }}">
                                {{ auth()->user()->short($order['client_address'], 30) }}
                            </p>
                        </td>

                        <td class="td">{{ $order['unit_load'] }}</td>

                        <td class='td'>
                            @livewire('user.modal-created-requests-live', [
                                'targetCustomer' => $order['target_customer'],
                                'netWeight' => $order['net_weight'],
                                'grossWeight' => $order['gross_weight'],
                                'clientAddress' => $order['client_address'],
                                'unitLoad' => $order['unit_load'],
                                'orderNumber' => $order['order_number'],
                            ], key($order['id'] . 'request'))
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            @if ($serch === true)
                                <p class="py-10 text-center">No se ha encontrado en la base de datos</p>
                            @else
                                <p class="py-10 text-center">Aun no se ha buscado ninguna orden</p>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
