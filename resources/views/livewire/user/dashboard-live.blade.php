<div class="screen-default">
    <div class="w-full">
        <div class="items-center gap-2 mb-6 row">
            <input
                type="text"
                wire:model.live="orderId"
                placeholder="Buscar por id"
                class="input-simple w-[300px]"
            >
        </div>

        <table class="w-full">
            <thead>
                <tr class="tr">
                    <th class="th">ID</th>
                    <th class="th">Cliente</th>
                    <th class="th">Orden</th>
                    <th class="th">Peso Total</th>
                    <th class="th">Dirección</th>
                    <th class="th">Contenedor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr wire:key='orden-{{ $order['id'] }}' class="tr">
                        <td class="td">#{{ $order['id'] }}</td>
                        <td class="td">{{ $order['target_customer'] }}</td>
                        <td class="td">{{ $order['order_number'] }}</td>
                        <td class="td">{{ $order['total_weighht'] }} kg</td>
                        <td class="td">{{ $order['client_address'] }}</td>
                        <td class="td">{{ $order['container'] }}</td>
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
</div>
