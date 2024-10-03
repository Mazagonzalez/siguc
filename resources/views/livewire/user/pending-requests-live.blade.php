<div>
    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Numero de orden</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th">Cantidad de ordenes</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr wire:key='orden-{{ $request->id }}' class="tr">
                    <td class="td">
                        <x-utils.status status="{{ $request->status }}" />
                    </td>

                    <td class="td">
                        @if ($request->id_request_double)
                            Order #1 {{ $request->order_number }} <br>
                            Order #2 {{ $request->request_double->order_number }}
                        @else
                            Order #1 {{ $request->order_number }}
                        @endif

                    </td>
                    <td class="td">{{ $request->date_quotation }}</td>
                    <td class="td">
                        @if ($request->status == '0')
                            <p>En espera</p>
                        @else
                            {{ $request->updated_at }}
                        @endif

                    </td>
                    <td class="td">
                        @if ($request->id_request_double)
                            <p>2</p>
                        @else
                            <p>1</p>
                        @endif
                    </td>

                    <td class="items-center justify-center gap-2 td row">
                        @if ($request->status == '1')
                            <button class="btn-confirm tooltip tooltip-top" data-tip="Aceptar" wire:click='confirmDelivery({{ $request->id }})' wire:key="show-accept-{{ $request->id }}">
                                <x-icons.checked class="size-5 stroke-white" />
                            </button>
                        @endif
                        @livewire('provider.details-request-live', ['request' => $request], key('detail-request-'.$request->id))

                        @livewire('user.decline-requests-live', ['request' => $request], key('reject-request-'.$request->id))
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
