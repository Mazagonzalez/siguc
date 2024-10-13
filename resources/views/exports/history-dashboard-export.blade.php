<table>
    <thead>
        <tr>
            <th style="font-weight: bold; background: #3b82f6; color: white"> # </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Tipo de orden </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Proveedor </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Numero de orden/proforma </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Nombre cliente </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Tipoo de vehiculo </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Tipo de contenedor </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Peso neto </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Peso bruto </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Cantidad de caja </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Flete inicial </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Flete final </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Fecha de entrega </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Fecha de creacion de la orden </th>
            <th style="font-weight: bold; background: #3b82f6; color: white"> Comentario </th>
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
                @if ($reques->type_request == 'Solicitud nacional')
                    <td style="font-weight: 300; text-align: start">
                        {{ $index + 1 }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->type_request }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->provider }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->order_number }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->client_name }}
                    </td>

                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->type_vehicle }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->container_type }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->order_weight }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->gross_weight }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>N/A</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        $ {{ $reques->requestNational->initial_flete }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        $ {{ $reques->requestNational->final_flete }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->date_quotation }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->created_at }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->comment }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->license_plate }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->driver_name }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->identification }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->date_acceptance }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->time_response }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestNational->date_loading }}
                    </td>
                @elseif ($reques->type_request == 'Solicitud termoformado')
                    <td style="font-weight: 300; text-align: start">
                        {{ $index + 1 }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->type_request }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->provider }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>N/A</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->client_name }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->type_vehicle }}
                    </td>
                    @if ($reques->requestThermoformed->type_vehicle == 'Tractomula')
                        <td style="font-weight: 300; text-align: start">
                            {{ $reques->requestThermoformed->container_type }}
                        </td>
                    @else
                        <td style="font-weight: 300; text-align: start">
                            <p>N/A</p>
                        </td>
                    @endif
                    <td style="font-weight: 300; text-align: start">
                        <p>N/A</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>N/A</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->box_quantity }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        $ {{ $reques->requestThermoformed->initial_flete }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        $ {{ $reques->requestThermoformed->final_flete }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->date_quotation }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->created_at }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->comment }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->license_plate }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->driver_name }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->identification }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->date_acceptance }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->time_response }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestThermoformed->date_loading }}
                    </td>
                    @elseif ($reques->type_request == 'Solicitud exportacion')
                    <td style="font-weight: 300; text-align: start">
                        {{ $index + 1 }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->type_request }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->provider }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->proforma_id }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->client_name }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->type_vehicle }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>Informacion en la proforma</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>Total: </p>{{ $reques->requestExportation->total_net_weight }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>Total: </p>{{ $reques->requestExportation->total_net_weight }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>N/A</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        $ {{ $reques->requestExportation->initial_flete }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        $ {{ $reques->requestExportation->final_flete }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->date_quotation }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->created_at }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->comment }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>Informacion en la proforma</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>Informacion en la proforma</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        <p>Informacion en la proforma</p>
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->date_acceptance }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->time_response }}
                    </td>
                    <td style="font-weight: 300; text-align: start">
                        {{ $reques->requestExportation->date_loading }}
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
