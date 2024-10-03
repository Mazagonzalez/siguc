<div class="gap-2 p-4 bg-gray-100 col rounded-3xl dark:bg-zinc-800">
    <p class="font-semibold text-center">Detalles segunda orden</p>

    <div class="text-xs divide-y divide-gray-300 col dark:divide-zinc-800">
        @if ($order_number)
            <div class="py-1.5 col">
                <span class="text-sm font-semibold">Numero de orde</span>
                <p class="font-light">{{ $order_number }}</p>
            </div>
        @endif
        @if ($target_customer)
            <div class="py-1.5 col">
                <span class="text-sm font-semibold">Nombre del cliente</span>
                <p class="font-light">{{ $target_customer }}</p>
            </div>
        @endif
        @if ($client_address)
            <div class="py-1.5 col">
                <span class="text-sm font-semibold">Direccion del cliente</span>
                <p class="font-light">{{ $client_address }}</p>
            </div>
        @endif
        @if ($unit_load)
            <div class="py-1.5 col">
                <span class="text-sm font-semibold">Tipo de contenedor</span>
                <p class="font-light">{{ $unit_load }}</p>
            </div>
        @endif
        @if ($net_weight)
            <div class="py-1.5 col">
                <span class="text-sm font-semibold">Peso neto</span>
                <p class="font-light">{{ $net_weight }}</p>
            </div>
        @endif
        @if ($gross_weight)
            <div class="py-1.5 col">
                <span class="text-sm font-semibold">Peso bruto</span>
                <p class="font-light">{{ $gross_weight }}</p>
            </div>
        @endif
    </div>
</div>
