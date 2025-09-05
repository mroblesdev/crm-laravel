<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle cliente</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        img{
            width: 70px;
        }
    </style>
</head>

<body>

    <img src="{{ public_path('storage/'.$logo) }}" alt="Logo">

    <h2>Detalle del cliente</h2>
    <p><strong>Nombre: </strong> {{ $client->name }}</p>
    <p><strong>Email: </strong> {{ $client->email }}</p>
    <p><strong>Teléfono: </strong> {{ $client->phone }}</p>
    <p><strong>Compañia: </strong> {{ $client->company }}</p>
    <p><strong>Notas: </strong> {{ $client->notes }}</p>

    <h3>Seguimientos</h3>

    <table>
        <thead>
            <tr>
                <th>Asunto</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($client->followUps as $follow)
            <tr>
                <td>{{ $follow->subject }}</td>
                <td>{{ $follow->description }}</td>
                <td>{{ $follow->follow_up_date }}</td>
                <td>{{ $follow->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>