<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página privada @auth de {{Auth::user()->name}} @endauth </title>
</head>
<body>
    <h1>Página privada @auth de {{ Auth::user()->name }} @endauth </h1>
    <a href="{{ route('logout') }}">
        <button type="button">Desconectar</button>
    </a>
<br>
    <a href="{{ route('subastas.index') }}">
        <button type="button">Ir a subastas</button>
    </a>
<br>
    <a href="{{ route('subastas.create') }}">
        <button type="button">Crear subasta</button>
    </a>
    
    <h2>Tu oro: {{Auth::user()->oro}}</h2>

    <h2>Tu inventario:</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
        </tr>
    </thead>
        <tbody>
            @php
                $productos_agrupados = [];
            @endphp

            @foreach ($user->productos as $producto)
                @php
                    $nombre = $producto->name;
                    $cantidad = $producto->pivot->cantidad;
                @endphp

                @if (isset($productos_agrupados[$nombre]))
                    @php
                        $productos_agrupados[$nombre] += $cantidad;
                    @endphp
                @else
                    @php
                        $productos_agrupados[$nombre] = $cantidad;
                    @endphp
                @endif
            @endforeach

            @foreach ($productos_agrupados as $nombre => $cantidad)
                <tr>
                    <td>{{ $nombre }}</td>
                    <td>{{ $cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </body>
</html>