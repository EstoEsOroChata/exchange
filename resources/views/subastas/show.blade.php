@extends('layouts.plantilla')

@section('title','Subasta de ' . $subasta->nombre)

@section('content')
    <h1>Subasta de: {{$subasta->nombre}}</h1>
    <a href="{{route('subastas.index')}}">Volver a subastas</a>
    <br>
    <a href="{{route('subastas.edit', $subasta)}}">Editar subasta</a>

    <p><strong>Cantidad disponible: </strong>{{$subasta->cantidad}}</p>
    <p><strong>Puja actual: </strong>{{$subasta->puja}}</p>
    <p><strong>Precio de compra: </strong>{{$subasta->precio}}</p>
    <p><strong>Fecha límite: </strong>{{$subasta->fecha_limite}}</p>
    
@endsection