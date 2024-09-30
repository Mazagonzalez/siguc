<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de contenedor</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de la solicitud</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <div class="items-center justify-center gap-2 row">
                            <div class="bg-yellow-500 rounded-full size-2"></div>
                            <span>En espera</span>
                        </div>
                    </td>

                    <td class="td">{{ $request->container_type }}</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">{{ $request->created_at }}</td>

                    <td class="items-center justify-center gap-2 td row">
                        <button wire:click="showRequest({{ $request->id }})" class="btn-acept-modal tooltip tooltip-top" data-tip="Más información">
                            <x-icons.info class="w-6 h-6 stroke-white" />
                        </button>

                        <button wire:click="acceptRequest({{ $request->id }})" class="btn-acept tooltip tooltip-top" data-tip="Aceptar">
                            @livewire('provider.accept-request-live', ['request' => $request], key('accept-request-'.$request->id))
                        </button>

                        <button wire:click="rejectRequest({{ $request->id }})" class="btn-decline tooltip tooltip-top" data-tip="Rechazar">
                            <x-icons.x-mark class="w-6 h-6 stroke-white" />
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <p class="py-20 text-center">No tiene solicitudes pendiente</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
