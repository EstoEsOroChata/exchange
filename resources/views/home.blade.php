<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Exchange</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid" style="margin-bottom: 40px">
        <div class="row">
            <div class="bg-image" style="background-image: url('https://i.gyazo.com/a87b7ca685d14403197eb7382f5e0ec2.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-size: cover">   
                <div style="padding-top: 10px;">
                    <a href="{{route('home')}}">
                        <img src="https://i.gyazo.com/4535fd5fe9889dbdaf5e02384f888481.png" class="img img-thumbnail" style="width: 15%; height: auto; min-width:200px" alt="Logo">
                    </a>
                </div>
                <div class="text-white d-flex justify-content-center align-items-center" style="height: calc(80vh - 50px);">
                    <div class="text-center" style="font-family: 'Russo One'">
                        <h3 class="display-4">COMPRA. VENDE.</h3>
                        <h1 class="display-1">GANA ORO.</h1>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-9" style="font-family: 'Russo One';">
                <div style="margin-top: 5px" class="text-end">
                    <h1 class="display-5" style="margin-right: 110px; text-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);">COMIENZA A COMPRAR, VENDER Y GANAR ORO</h1>
                </div>
            </div>
            <div class="col-3 align-items-start">
                <a class="btn btn-primary btn-lg" href="{{route('iniciar-sesion')}}" role="button" style="margin-top: 8px; margin-right: 20px; box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);">Iniciar sesión</a>
                <a class="btn btn-primary btn-lg" href="{{route('registro')}}" role="button" style="margin-top: 8px; box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);">Regístrate</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>