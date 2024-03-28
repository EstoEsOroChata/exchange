<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
    <body>
        <form method="POST" action="{{route('validar')}}">

        @csrf
        
        <label>
            Nombre:
            <br>
            <input type="text" name="nombre">
        </label>

        <br>
        
        <label>
            Email:
            <br>
            <input type="email" name="email">
        </label>

        <br>
                
        <label>
            Contraseña:
            <br>
            <input type="password" name="contrasena">
        </label>

        <br>

        <button type="submit">
            Registrarse
        </button>
        </form>
    </body>
</html>