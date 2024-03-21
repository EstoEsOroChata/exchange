@extends('layouts.plantilla')

@section('title','Subastas create')

@section('content')
    <h1>Aquí puedes crear una subasta</h1>

    <form action="{{route('subastas.store')}}" method="POST">

    @csrf

    <label>
        Nombre:
        <br>
        <input type="text" name="nombre">
    </label>
    <br>
    <label>
        Cantidad:
        <br>
        <input type="text" name="cantidad">
    </label>
    <br>
    <label>
        Puja:
        <br>
        <input type="text" name="puja">
    </label>
    <br>
    <label>
        Precio:
        <br>
        <input type="text" name="precio">
    </label>
    <br>
    <label>
        Fecha límite:
        <br>
        <input type="datetime-local" name="fecha_limite">
    </label>
    <br>
    <button type="submit">Crear subasta</button>
    </form>
@endsection