<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Subasta de {{$subasta->name}}</title>
    
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

                        <li class="nav-item" style="display: flex; margin-right: 10px;">
                            <a class="btn btn-dark" href="{{ route('perfil.show', ['id' => Auth::id()]) }}">Mi perfil</a>
                        </li>
                    </ul>
                </nav>
                
                <div class="d-flex justify-content-center align-items-start" style="padding-top: 10px;">
                    <div style="background-color: rgba(255, 255, 255, 0.5); border-radius: 20px; padding: 15px;">
                        <h1 class="display-5 text-center mb-4" style="font-weight: bold;">Subasta de: {{$subasta->name}}</h1>
                        <div style="font-size: 20px;">
                
                            <!-- Información de la subasta -->
                            <p><strong>Cantidad disponible: </strong>{{$subasta->cantidad}}</p>
                            <p><strong>Puja actual: </strong>{{$subasta->puja}}</p>
                            <p><strong>Precio de compra: </strong>{{$subasta->precio}}</p>
                            <p><strong>Fecha límite: </strong>{{$subasta->fecha_limite}}</p>
                            <p>Creador de la subasta: <a href="{{ route('perfil.show', $subasta->user->id) }}">{{ $subasta->user->name }}</a></p>
                        </div>
                        <!-- Realizar una puja si no eres el creador de la subasta -->
                        @if(auth()->check() && auth()->id() !== $subasta->user_id)
                            <form action="{{ route('subastas.pujar', $subasta) }}" method="POST">
                                @csrf
                                <div style="font-size: 20px;" class="form-group">
                                    <label for="puja">Realizar puja:</label>
                                    <input type="number" id="puja" name="puja" min="{{$subasta->puja + 1}}" value="{{$subasta->puja + 1}}" class="form-control" required>
                                    <div style="padding-top: 10px;">
                                    <button class="btn btn-info" style="margin-bottom: 10px" type="submit">Pujar</button>
                                    </div>
                                    @error('puja')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </form>
                        @endif
                
                        <!-- Botón para comprar el producto si no eres el creador de la subasta -->
                        @if(auth()->check() && auth()->id() !== $subasta->user_id)
                            <form action="{{ route('subastas.comprar', $subasta) }}" method="POST">
                                @csrf
                                <button class="btn btn-success" style="margin-bottom: 10px" type="submit">Comprar por {{ $subasta->precio }} oros</button>
                                @error('compra')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </form>
                        @endif
                        <!-- Acciones para el dueño de la subasta -->
                        <div style="display: flex; gap: 10px; align-items: center;">
                            @if(auth()->check() && auth()->id() === $subasta->user_id)
                            <a class="btn btn-warning" href="{{ route('subastas.edit', $subasta) }}">Editar subasta</a>
                            @endif
                            @if(auth()->user()->id === $subasta->user_id)
                                <form action="{{ route('subastas.finalizar', $subasta) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success" type="submit">Finalizar Subasta</button>
                                </form>
                            @endif
                
                            <!-- Eliminar subasta (solo lo ve el dueño de la subasta) -->
                            @if(auth()->check() && (auth()->id() === $subasta->user_id || auth()->user()->es_admin))
                            <form id="deleteForm" action="{{route('subastas.destroy', $subasta)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="button" onclick="confirmDelete()">Eliminar subasta</button>
                            </form>
                            @endif
                            <script>
                                function confirmDelete() {
                                    if (confirm("¿Estás seguro de que deseas eliminar esta subasta?")) {
                                        document.getElementById("deleteForm").submit();
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
                
</body>
</html>
