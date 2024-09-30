<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Tipo de contenedor</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de finalizacion</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        @if($request->status == 2)
                            <div class="items-center justify-center gap-2 row">
                                <div class="bg-red-500 rounded-full size-2"></div>
                                <span>Rechazado</span>
                            </div>
                        @elseif($request->status == 3)
                            <div class="items-center justify-center gap-2 row">
                                <div class="rounded-full bg-emerald-500 size-2"></div>
                                <span>Finalizado</span>
                            </div>
                        @else
                            <div class="items-center justify-center gap-2 row">
                                <div class="bg-yellow-500 rounded-full size-2"></div>
                                <span>Pendiente</span>
                            </div>
                        @endif
                    </td>

                    <td class="td">{{ $request->container_type }}</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">{{ $request->updated_at }}</td>

                    <td class="flex justify-center td">
                        <button wire:click="showRequest({{ $request->id }})" class="btn-acept-modal tooltip tooltip-top" data-tip="Más información">
                            <x-icons.info class="w-6 h-6 stroke-white" />
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <p class="py-20 text-center">No tiene historial de solicitudes</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>