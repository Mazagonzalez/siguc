<table>
    <thead>
        <tr>
            <th> Proveedor </th>
            <th> Numero de orden </th>
            <th> Nombre cliente </th>
            <th> Tipo de contenedor </th>
            <th> Peso neto </th>
            <th> Peso bruto </th>
            <th> Flete inicial </th>
            <th> Flete final </th>
            <th> Fecha de entrega </th>
            <th> Fecha de creacion de la orden </th>
            <th> Comentario </th>
            <th> Tipoo de vehiculo </th>
            <th> Placa del vehiculo </th>
            <th> Nombre del conductor </th>
            <th> Identificacion del conductor </th>
            <th> Fecha de aceptacion </th>
            <th> Tiempo de respuesta </th>
            <th> Fecha de finalizacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($request as $reques)
            <tr>
                <td class="text-xs font-semibold">
                    {{ $reques->provider }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->order_number }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->client_name }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->container_type }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->order_weight }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->gross_weight }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->initial_flete }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->final_flete }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->date_quotation }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->updated_at }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->comment }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->type_vehicle }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->license_plate }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->driver_name }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->identification }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->date_acceptance }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->time_response }}
                </td>
                <td class="text-xs font-semibold">
                    {{ $reques->date_loading }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
