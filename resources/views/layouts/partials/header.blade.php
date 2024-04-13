<header>
    <h1>Exchange</h1>
@auth
    <a href="{{ route('perfil.show', ['name' => Auth::user()->name])}}">
        <button type="button">Mi perfil</button>
    </a>
@endauth

@guest
   <h1>Bienvenido usuario no registrado, recuerda que puedes registrarte desde <a href="{{route('registro')}}">aquí</a></h1>
@endguest

    <nav>
        <ul>
            <li><a href="{{route('home')}}" class="{{request()->RouteIs('home') ? 'active' : ''}}">Home</a>
            </li>
            <li><a href="{{route('subastas.index')}}" class="{{request()->RouteIs('subastas.*') ? 'active' : ''}}">Subastas</a>
            </li>
            <li><a href="{{route('nosotros')}}" class="{{request()->RouteIs('nosotros') ? 'active' : ''}}">Sobre nosotros</a>
            </li>
            <li><a href="{{route('contacto.index')}}" class="{{request()->RouteIs('contacto.index') ? 'active' : ''}}">Contáctanos</a>
            </li>
        </ul>
    </nav>
</header>