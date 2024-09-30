<div>
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
                                Rechazado
                            @elseif($request->status == 3)
                                Finalizado
                            @else
                                Pendiente
                            @endif
                        </td>
                        <td class="td">{{ $request->container_type }}</td>
                        <td class="td">{{ $request->date_quotation }}</td>
                        <td class="td">{{ $request->updated_at }}</td>
                        <td class="td">
                            <button wire:click="showRequest({{ $request->id }})" class="btn btn-info">Mas informacion</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <p class="py-10 text-center">No tiene historial de solicitudes</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
