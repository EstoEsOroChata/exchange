<header>
    <h1>Exchange</h1>

    <a href="{{ route('perfil') }}">
        <button type="button">Mi perfil</button>
    </a>
    
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