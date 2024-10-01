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

                    <td class="items-center justify-center gap-2 td row" style="text-align: start">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('provider.accept-request-live', ['request' => $request], key('accept-request-'.$request->id))

                        @livewire('provider.decline-request-live', ['request' => $request], key('reject-request-'.$request->id))
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
