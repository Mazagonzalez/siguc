<div>
    <div>
        <table class="w-full">
            <thead>
                <tr class="tr">
                    <th class="th">Estado</th>
                    <th class="th">Tipo de contenedor</th>
                    <th class="th">Fecha de entrega</th>
                    <th class="th">Fecha de la solicitud</th>
                    <th class="th"></th>
                    <th class="th"></th>
                    <th class="th"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr wire:key='orden-{{ $request->id }}' class="tr">
                        <td class="td">En espera</td>
                        <td class="td">{{ $request->container_type }}</td>
                        <td class="td">{{ $request->date_quotation }}</td>
                        <td class="td">{{ $request->created_at }}</td>
                        <td class="td">
                            <button wire:click="showRequest({{ $request->id }})" class="btn btn-info">Mas informacion</button>
                        </td>
                        <td class="td">
                            <button wire:click="acceptRequest({{ $request->id }})" class="btn btn-primary">Aceptar</button>
                        </td>
                        <td class="td">
                            <button wire:click="rejectRequest({{ $request->id }})" class="btn btn-danger">Rechazar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <p class="py-10 text-center">No tiene solicitudes pendiente</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
