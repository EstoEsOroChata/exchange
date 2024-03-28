<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <h1>Registrarse en Exchange</h1>
</head>
    <body>
        <form method="POST" action="{{route('validar')}}">

        @csrf
        
        <label>
            Nombre:
            <br>
            <input type="text" name="name">
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
            <input type="password" name="password">
        </label>

        <br>

        <button type="submit">
            Registrarse
        </button>
        </form>
    </body>
</html>