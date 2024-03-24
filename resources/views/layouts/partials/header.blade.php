<header>
    <h1>Exchange</h1>
    <nav>
        <ul>
            <li><a href="{{route('home')}}" class="{{request()->RouteIs('home') ? 'active' : ''}}">Home</a>
            </li>
            <li><a href="{{route('subastas.index')}}" class="{{request()->RouteIs('subastas.*') ? 'active' : ''}}">Subastas</a>
            </li>
            <li><a href="{{route('nosotros')}}" class="{{request()->RouteIs('nosotros') ? 'active' : ''}}">Sobre nosotros</a>
            </li>
        </ul>
    </nav>
</header>