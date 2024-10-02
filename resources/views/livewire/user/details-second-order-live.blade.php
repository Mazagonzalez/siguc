<div>
    <button
        wire:click="showModal"
        class="btn-info tooltip tooltip-top"
        data-tip="Más información"
    >
        <x-icons.info class="size-6 stroke-white" />
    </button>

    <x-dialog-modal wire:model='open' maxWidth="md" >
        <x-slot name="title">
            <div class="items-center col">
                <p class="text-xl font-semibold text-center">Detalles de la segunda orde</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-300 col dark:divide-zinc-800">
                @if ($order_number)
                    <div class="py-2 col">
                        <span class="text-base font-semibold">Numero de orde</span>
                        <p class="font-light">{{ $order_number }}</p>
                    </div>
                @endif
                @if ($target_customer)
                    <div class="py-2 col">
                        <span class="text-base font-semibold">Nombre del cliente</span>
                        <p class="font-light">{{ $target_customer }}</p>
                    </div>
                @endif
                @if ($client_address)
                    <div class="py-2 col">
                        <span class="text-base font-semibold">Direccion del cliente</span>
                        <p class="font-light">{{ $client_address }}</p>
                    </div>
                @endif
                @if ($unit_load)
                    <div class="py-2 col">
                        <span class="text-base font-semibold">Tipo de contenedor</span>
                        <p class="font-light">{{ $unit_load }}</p>
                    </div>
                @endif
                @if ($net_weight)
                    <div class="py-2 col">
                        <span class="text-base font-semibold">Peso neto</span>
                        <p class="font-light">{{ $net_weight }}</p>
                    </div>
                @endif
                @if ($gross_weight)
                    <div class="py-2 col">
                        <span class="text-base font-semibold">Peso bruto</span>
                        <p class="font-light">{{ $gross_weight }}</p>
                    </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="close" class="btn-close-modal">
                <p class="font-light">Atras</p>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
