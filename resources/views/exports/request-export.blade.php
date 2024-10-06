<table>
    <thead>
        <tr>
            <th style="font-weight: bold; background: #3b82f6; color: white"> # </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Proveedor </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Numero de orden </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Nombre cliente </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Tipo de contenedor </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Peso neto </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Peso bruto </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Flete inicial </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Flete final </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Fecha de entrega </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Fecha de creacion de la orden </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Comentario </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Tipoo de vehiculo </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Placa del vehiculo </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Nombre del conductor </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Identificacion del conductor </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Fecha de aceptacion </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Tiempo de respuesta </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Fecha de finalizacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($request as $index => $reques)
            <tr>
                <td style="font-weight: 300; text-align: start">
                    {{ $index + 1 }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->provider }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->order_number }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->client_name }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->container_type }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->order_weight }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->gross_weight }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    $ {{ $reques->initial_flete }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    $ {{ $reques->final_flete }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->date_quotation }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->updated_at }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->comment }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->type_vehicle }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->license_plate }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->driver_name }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->identification }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->date_acceptance }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->time_response }}
                </td>
                <td style="font-weight: 300; text-align: start">
                    {{ $reques->date_loading }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
