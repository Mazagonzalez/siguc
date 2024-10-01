<div class="gap-5 screen-default col">
    <div class="w-full">
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
                                'unitLoad' => $order['unit_load']
                            ], key($order['id'] . 'request'))
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <p class="py-10 text-center">No se ha encontrado en la base de datos</p>
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
