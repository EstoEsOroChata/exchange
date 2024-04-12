@extends('layouts.plantilla')

@section('title','Subasta de ' . $subasta->name)

@section('content')
    <h1>Subasta de: {{$subasta->name}}</h1>

@if(auth()->check() && auth()->id() === $subasta->user_id)
    <a href="{{ route('subastas.edit', $subasta) }}">Editar subasta</a>
@endif

    <a href="{{route('subastas.index')}}">Volver a subastas</a>
    <br>

    <p><strong>Cantidad disponible: </strong>{{$subasta->cantidad}}</p>
    <p><strong>Puja actual: </strong>{{$subasta->puja}}</p>
    <p><strong>Precio de compra: </strong>{{$subasta->precio}}</p>
    <p><strong>Fecha límite: </strong>{{$subasta->fecha_limite}}</p>

    <br>

    @if(auth()->check() && auth()->id() !== $subasta->user_id)
    <form action="{{ route('subastas.pujar', $subasta) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="puja">Realizar puja:</label>
            <input type="number" id="puja" name="puja" min="{{$subasta->puja + 1}}" value="{{$subasta->puja + 1}}" required>
            <button type="submit">Pujar</button>
        </div>
    </form>
@endif

    <br>

    @if(auth()->check() && auth()->id() !== $subasta->user_id)
    <form action="{{ route('subastas.comprar', $subasta) }}" method="POST">
        @csrf
        <button type="submit">Comprar por {{ $subasta->precio }} oros</button>
    </form>
@endif

@if(auth()->user()->id === $subasta->user_id)
    <form action="{{ route('subastas.finalizar', $subasta) }}" method="POST">
        @csrf
        <button type="submit">Finalizar Subasta</button>
    </form>
@endif

    {{-- Meto el botón de eliminar dentro de un formulario para que me use el método delete de "SubastaController.php" si no, por defecto, me usa el método "get". --}}
    <form action="{{route('subastas.destroy', $subasta)}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Eliminar subasta</button>
    </form>
    
@endsection