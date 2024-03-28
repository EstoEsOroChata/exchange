<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
    <body>
        <form method="POST" action="{{route('login')}}">
          <h1>Iniciar sesión</h1>
        
        @csrf
        
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
                
        <label>
            Mantener sesión iniciada
            <input type="checkbox" name="recordar">
        </label>

        <br>

      ¿No tienes cuenta? <a href="{{route('registro')}}">Regístrate</a>

        <br>

      <button type="submit">
        Entrar
      </button>
        </form>
    </body>
</html>