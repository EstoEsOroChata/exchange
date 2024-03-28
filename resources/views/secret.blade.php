<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página privada @auth de {{Auth::user()->name}} @endauth </title>
</head>
<body>
    <h1>Página privada @auth de {{Auth::user()->name}} @endauth </h1>
    <a href="{{route('logout')}}">
        <button type="button">Salir</button>
    </a>
</body>
</html>