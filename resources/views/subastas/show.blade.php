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

    {{-- Meto el botón de eliminar dentro de un formulario para que me use el método delete de "SubastaController.php" si no, por defecto, me usa el método "get". --}}
    <form action="{{route('subastas.destroy', $subasta)}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Eliminar subasta</button>
    </form>
    
@endsection