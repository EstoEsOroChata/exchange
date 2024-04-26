<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Perfil de {{$usuario->name}}</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui@1.13.2/jquery-ui.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    
        <style>
            .ui-autocomplete {
                list-style-type: none;
                position: absolute;
                background-color: white;
                border: 1px solid #ccc;
                max-height: 200px;
                overflow-y: auto;
                z-index: 1000;
                width: 400px;
            }
    
            .ui-autocomplete .ui-menu-item {
                padding: 8px 12px;
                cursor: pointer;
            }
    
            .ui-autocomplete .ui-menu-item:hover {
                background-color: #f0f0f0;
            }
    
            .ui-helper-hidden-accessible {
            display: none;
    }
        </style>
    </head>
<body>

    <div class="container-fluid" style="font-family: 'Poppins';">
        <div class="row">
            <div class="bg-image" style="background-image: url('https://i.gyazo.com/a87b7ca685d14403197eb7382f5e0ec2.jpg'); background-repeat: no-repeat; background-size: cover; height: 100vh"> 

                <nav class="navbar navbar-light" style="background-color: rgba(255, 255, 255, 0.5); border-radius: 20px;">
                    <a style="padding-left: 8px" class="navbar-brand" href="{{route('home')}}">
                        <img src="https://i.gyazo.com/4535fd5fe9889dbdaf5e02384f888481.png" class="img-thumbnail" style="width: auto; height: 50px; min-width: 200px;" alt="Logo">
                    </a>
                    <ul class="nav nav-pills" style="margin-right: auto;">
                        <li class="nav-item" style="padding-right: 20px;">
                            <a class="btn btn-primary" href="{{route('subastas.index')}}">Ir a subastas</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{route('subastas.create')}}">Crear subasta</a>
                        </li>
                    </ul>
                
                    <ul class="nav nav-pills" style="">
                        <form class="form-inline" style="display: flex; margin-right: 100px;" >
                            <input class="form-control mr-sm-2" id="search" style="width: 450px;" placeholder="Buscar subasta" aria-label="Search">
                        </form>

                        <li class="nav-item" style="padding-right: 10px">
                            <a class="btn btn-danger" href="{{route('logout')}}">Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>

                <div class="d-flex justify-content-center align-items-center" style="padding-top: 15px;">
                <div class="" style="background-color: rgba(255, 255, 255, 0.5); border-radius: 20px; padding-left: 15px; padding-right: 15px; padding-top: 5px;">
                    <h1 class="display-5" style="font-weight: bold;">Perfil de {{$usuario->name}} </h1>
                     <div>

                    <!-- Oro del usuario -->
                    @if(Auth::user()->id == $usuario->id)
                    <h2>Dinero: {{Auth::user()->oro}} <img src="https://i.gyazo.com/7119885b63b3be6949d26f8b92255a31.png" alt="oro" width="30" height="30" style="border-radius: 5px;"></h2>
                    @endif
                </div>

                <!-- Inventario del usuario -->
                <div style="padding-top: 15px;">
                    @if(Auth::user()->id == $usuario->id)
                    <h2>Tu inventario:</h2>
                    @if($usuario->productos->isEmpty())
                    <p>Tu inventario está vacío en este momento.</p>
                    @else
                    <table class="table table-hover table-bordered text-center">
                    <thead  class="table-warning align-middle">
                        <tr>
                            <th>Objeto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                        <tbody>
                            @php
                                $productos_agrupados = [];
                            @endphp
                
                            <!-- Agrupación de productos -->
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
                
                            <!-- Mostrar productos agrupados -->
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
                @endif   
            </div>

                    <!-- Subastas del usuario -->
                    @if (Auth::user()->id == $usuario->id)
                        <h2>Tus subastas:</h2>
                        <div style="padding-bottom: 15px">
                        <div class="overflow-auto" style="max-height: 340px; padding-bottom: 5px;">
                        @else
                            <h2>Subastas de {{$usuario->name}}</h2>
                        @endif
                
                        <!-- Lista de subastas -->
                        @if ($subastas->count() > 0)
                            <ul class="list-group">
                             @foreach ($subastas as $subasta)
                                  <a href="{{ route('subastas.show', $subasta) }}" class="list-group-item list-group-item-action">{{ $subasta->name }}</a>
                             @endforeach
                         </ul>
                     @else
                         <p>No tienes subastas activas en este momento.</p>
                     @endif
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            $('#search').autocomplete({ 
            source: function(request, response){
                $.ajax({
                    url: "{{route('search.subastas')}}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data){
                        response(data)
                    }
                });
            },
            select: function(event, ui) {
                window.location.href = "{{ route('subastas.show', '') }}/" + ui.item.slug;
            }
        });
        </script>
    </body>
</html>