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
            Su orden ha sido completada con éxito.
        </h1>
        <p>
            Hola {{ $request->client_name }}, su orden ha sido completada con éxito.
        </p>
        <p>
            comentario: {{ $comment }}
        </p>
</body>
</html>
