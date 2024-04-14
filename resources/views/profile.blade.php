<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil de {{$usuario->name}}</title>
</head>
<body>
    <h1>Perfil de {{$usuario->name}} </h1>
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
    
    @if(Auth::user()->id == $usuario->id)
    <h2>Tu oro: {{Auth::user()->oro}}</h2>
    @endif

    @if(Auth::user()->id == $usuario->id)
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

            @foreach ($usuario->productos as $producto)
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
                @if ($cantidad > 0)
                <tr>
                    <td>{{ $nombre }}</td>
                    <td>{{ $cantidad }}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    @endif
    
    @if (Auth::user()->id == $usuario->id)
        <h2>Tus subastas:</h2>
        @else
            <h2>Subastas de {{$usuario->name}}</h2>
        @endif

        @if ($subastas->count() > 0)
            <ul>
             @foreach ($subastas as $subasta)
                  <li><a href="{{ route('subastas.show', $subasta) }}">{{ $subasta->name }}</a></li>
             @endforeach
         </ul>
     @else
         <p>No tienes subastas activas en este momento.</p>
     @endif

    </body>
</html>