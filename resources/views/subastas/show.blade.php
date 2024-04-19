<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subasta de {{$subasta->name}}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="bg-image" style="background-image: url('https://i.gyazo.com/a87b7ca685d14403197eb7382f5e0ec2.jpg'); background-repeat: no-repeat; background-size: cover; height: 100vh"> 
                <!-- Navbar -->
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
                    <form class="form-inline" style="display: flex; margin-top: 15px;" >
                        <input class="form-control mr-sm-2" type="search" style="width: 460px;" placeholder="Buscar subasta" aria-label="Search">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                    <ul class="nav nav-pills" style="margin-left: auto; padding-right: 10px;">
                        <li class="nav-item">
                            <a class="btn btn-dark" href="{{ route('perfil.show', ['id' => Auth::id()]) }}">Mi perfil</a>
                        </li>
                    </ul>
                </nav>
                <!-- Content -->
                <div class="d-flex justify-content-center align-items-start" style="padding-top: 10px;">
                    <div style="background-color: rgba(255, 255, 255, 0.5); border-radius: 20px; padding: 15px;">
                        <h1 class="display-5 text-center mb-4" style="font-family: 'Poppins'; font-weight: bold;">Subasta de: {{$subasta->name}}</h1>
                        <div style="font-family: 'Poppins'; font-size: 20px;">
                            <p><strong>Cantidad disponible: </strong>{{$subasta->cantidad}}</p>
                            <p><strong>Puja actual: </strong>{{$subasta->puja}}</p>
                            <p><strong>Precio de compra: </strong>{{$subasta->precio}}</p>
                            <p><strong>Fecha límite: </strong>{{$subasta->fecha_limite}}</p>
                            <p>Creador de la subasta: <a href="{{ route('perfil.show', $subasta->user->id) }}">{{ $subasta->user->name }}</a></p>
                        </div>
                        @if(auth()->check() && auth()->id() !== $subasta->user_id)
                            <form action="{{ route('subastas.pujar', $subasta) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="puja">Realizar puja:</label>
                                    <input type="number" id="puja" name="puja" min="{{$subasta->puja + 1}}" value="{{$subasta->puja + 1}}" required>
                                    <button type="submit">Pujar</button>
                                </div>
                            </form>
                        @endif
                        @if(auth()->check() && auth()->id() !== $subasta->user_id)
                            <form action="{{ route('subastas.comprar', $subasta) }}" method="POST">
                                @csrf
                                <button type="submit">Comprar por {{ $subasta->precio }} oros</button>
                            </form>
                        @endif
                        <div style="display: flex; gap: 10px; align-items: center;">
                        @if(auth()->check() && auth()->id() === $subasta->user_id)
                        <a style="font-family: 'Poppins';" class="btn btn-warning" href="{{ route('subastas.edit', $subasta) }}">Editar subasta</a>
                        @endif
                        @if(auth()->user()->id === $subasta->user_id)
                            <form action="{{ route('subastas.finalizar', $subasta) }}" method="POST">
                                @csrf
                                <button style="font-family: 'Poppins';" class="btn btn-success" type="submit">Finalizar Subasta</button>
                            </form>
                        @endif
                        <!-- Eliminar Subasta -->
                        <form action="{{route('subastas.destroy', $subasta)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button style="font-family: 'Poppins';" class="btn btn-danger" type="submit">Eliminar subasta</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
