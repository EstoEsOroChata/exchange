<header>
    <h1>Exchange</h1>
@auth
    <a href="{{ route('perfil.show', ['id' => Auth::user()->id])}}">
        <button type="button">Mi perfil</button>
    </a>
@endauth

@guest
   <h1>Bienvenido usuario no registrado, recuerda que puedes registrarte desde <a href="{{route('registro')}}">aquí</a></h1>
@endguest

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
</header>