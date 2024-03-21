@extends('layouts.plantilla')

@section('title','Subastas')

@section('content')
    <h1>Página principal de las subastas</h1>
    {{-- Con el método route puedo pasarle el nombre de la ruta de web.php --}}
    <a href="{{route('subastas.create')}}">Crear subasta</a>
    <ul>
        {{-- Recorro por todas las filas de  la tabla con un foreach y lo muestro en una lista --}}
        @foreach ($subastas as $subasta)
            <li>
                <a href="{{route('subastas.show', $subasta->id)}}">{{$subasta->nombre}}</a>
            </li>
        @endforeach
    </ul>

{{$subastas->links()}}

@endsection