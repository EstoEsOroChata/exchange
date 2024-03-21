@extends('layouts.plantilla')

@section('title','Subastas edit')

@section('content')
    <h1>Aquí puedes editar una subasta</h1>

    <form action="{{route('subastas.update', $subasta)}}" method="POST">

    @csrf
    @method('put')

    <label>
        Nombre:
        <br>
        <input type="text" name="nombre" value="{{$subasta->nombre}}">
    </label>
    <br>
    <label>
        Cantidad:
        <br>
        <input type="text" name="cantidad" value="{{$subasta->cantidad}}">
    </label>
    <br>
    <label>
        Puja:
        <br>
        <input type="text" name="puja" value="{{$subasta->puja}}">
    </label>
    <br>
    <label>
        Precio:
        <br>
        <input type="text" name="precio" value="{{$subasta->precio}}">
    </label>
    <br>
    <label>
        Fecha límite:
        <br>
        <input type="datetime-local" name="fecha_limite" value="{{$subasta->fecha_limite}}">
    </label>
    <br>
    <button type="submit">Guardar cambios</button>
    </form>
@endsection