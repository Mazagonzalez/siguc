<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de contenedor</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <div class="items-center justify-center gap-2 row">
                            <div class="rounded-full bg-emerald-500 size-2"></div>
                            <span>En espera</span>
                        </div>
                    </td>

                    <td class="td">{{ $request->container_type }}</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">{{ $request->updated_at }}</td>

                    <td class="items-center justify-center gap-2 td row">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        <button wire:click="rejectRequest({{ $request->id }})" class="btn-decline tooltip tooltip-top" data-tip="Cancelar Pedido">
                            <x-icons.x-mark class="w-6 h-6 stroke-white" />
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <p class="py-20 text-center">No tienes solicitudes en proceso</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
