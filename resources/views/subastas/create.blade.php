<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crea tu subasta</title>

    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="container-fluid">
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
                    </ul>
                
                    <ul class="" style="padding-right: 350px;">
                        <form class="form-inline" style="display: flex; margin-top: 15px;" >
                            <input class="form-control mr-sm-2" type="search" style="width: 460px;" placeholder="Buscar subasta" aria-label="Search">
                            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </ul>
                
                    <ul class="nav nav-pills" style="margin-left: auto; padding-right: 10px;">
                        <li class="nav-item">
                            <a class="btn btn-dark" href="{{ route('perfil.show', ['id' => Auth::id()]) }}">Mi perfil</a>
                        </li>
                    </ul>
                </nav>
                
                <div class="d-flex justify-content-start align-items-center" style="padding-top: 15px;">
                <div style="background-color: rgba(255, 255, 255, 0.5); border-radius: 20px; padding-left: 15px; padding-right: 15px; padding-top: 5px;">
                    
                    <form action="{{route('subastas.store')}}" method="POST">
                    @csrf

                    <div style="padding-top: 15px;">
                        <h2 style="font-family: 'Poppins';">Crear subasta</h2>
                    <select class="form-select mb-3" name="producto_id" required>
                        <option selected disabled value="">Selecciona un producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{$producto->id}}">
                            {{$producto->name}} ({{$producto->pivot->cantidad}} disponibles)
                        </option>
                    @endforeach
                    </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('cantidad') is-invalid @enderror" id="floatingInputCantidad" placeholder="Cantidad" name="cantidad" value="{{old('cantidad')}}" required>
                        <label for="floatingInputCantidad">Cantidad</label>
                        @error('cantidad')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('puja') is-invalid @enderror" id="floatingInputPuja" placeholder="Precio" name="puja" value="{{old('puja')}}" required>
                        <label for="floatingInput">Puja</label>
                        @error('puja')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('precio') is-invalid @enderror" id="floatingInput" placeholder="Cantidad" name="precio" value="{{old('precio')}}" required>
                        <label for="floatingInput">Precio</label>
                        @error('precio')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div>
                    <select class="form-select mb-3 @error('duracion_subasta') is-invalid @enderror" name="duracion_subasta" value="{{old('duracion_subasta')}}" required>
                        <option selected disabled value="">Selecciona el tiempo límite de la subasta</option>
                        <option value="12">12 horas</option>
                        <option value="24">24 horas</option>
                        <option value="48">48 horas</option>
                    </select>
                    @error('duracion_subasta')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>

                    <div style="padding-bottom: 15px;">
                    <button type="submit" class="btn btn-primary">Crear subasta</button>
                    </div>
                </form>
                </div>
            </div>
                    </div>      
                </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>