<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h1>
            Su orden ha sido aceptada
        </h1>
        <p>
            Hola {{ $request->client_name }}, su orden ha sido aceptada por la empresa {{ $request->provider }} para el dia {{  $request->date_quotation }}
        </p>
        <p>
            Direccion del pedido: {{ $request->client_address }} <br>
            Ciudad: {{ $request->city }} <br>
            Cantidad de cajas: {{ $request->box_quantity }} <br>
        </p>
        <p>
            Informacion del vehiculo: <br>
            Vehiculo: {{ $request->type_vehicle }} <br>
            @if ($request->container_type)
                Tipo de contenedor: {{ $request->container_type }} <br>
            @endif
            Placa: {{ $request->license_plate }} <br>
            Nombre del conductor: {{ $request->driver_name }} <br>
            Telefono del conductor: {{ $request->driver_phone }} <br>
            Identificacion del conductor: {{ $request->identification }} <br>
        </p>
        <p>
            Comentario: {{ $comment }}
        </p>
</body>
</html>
