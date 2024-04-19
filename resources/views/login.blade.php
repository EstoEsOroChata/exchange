<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión en Exchange</title>

    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


</head>
<body>
    <div class="container-fluid" style="font-family: 'Poppins';">
        <div class="row">
            <div class="bg-image" style="background-image: url('https://i.gyazo.com/a87b7ca685d14403197eb7382f5e0ec2.jpg'); background-repeat: no-repeat; background-size: cover; height: 100vh">   
                <div style="padding-top: 10px;">
                    <a href="{{route('home')}}">
                        <img src="https://i.gyazo.com/4535fd5fe9889dbdaf5e02384f888481.png" class="img img-thumbnail" style="width: 15%; height: auto; min-width:200px" alt="Logo">
                    </a>
                </div>
                <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
                    <div style="background-color: rgba(255, 255, 255, 0.5); border-radius: 20px;">
                        <form method="POST" action="{{route('login')}}" class="p-4">
                            <h1 class="display-4" style="font-weight: bold;">Iniciar sesión</h1>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label w-100">
                                    <h4>Email:</h4>
                                    <input placeholder="Ingrese su correo electrónico" class="form-control w-100" type="email" name="email">
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label w-100">
                                    <h4>Contraseña:</h4>
                                    <input class="form-control" type="password" name="password">
                                </label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="recordar">
                                <label class="form-check-label"><h6>Mantener sesión iniciada</h6></label>
                            </div>
                            <div class="mb-3">
                                <h6>¿No tienes cuenta?<a href="{{route('registro')}}"> Regístrate</h6></a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
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