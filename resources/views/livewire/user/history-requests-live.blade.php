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
                        <x-utils.status status="{{ $request->status }}" />
                    </td>

                    <td class="td">{{ $request->container_type }}</td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">
                        @if ($request->status == 2)
                            {{ $request->date_decline }}
                        @elseif ($request->status == 3)
                            {{ $request->date_loading }}
                        @endif
                    </td>

                    <td class="flex justify-center td">
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <p class="py-20 text-center">No tiene historial de solicitudes finalizada</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
