@extends('layouts.plantilla')

@section('title','Subastas create')

@section('content')
    <h1>Aquí puedes crear una subasta</h1>
    <a href="{{route('subastas.index')}}">Volver a subastas</a>

    <form action="{{route('subastas.store')}}" method="POST">

    @csrf

    <br>
    
    <label>
        Nombre:
        <br>
        <input type="text" name="nombre"  value="{{old('nombre')}}">
    </label>

    @error('nombre')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror

    <br>

    <label>
        Cantidad:
        <br>
        <input type="text" name="cantidad" value="{{old('cantidad')}}">
    </label>

    @error('cantidad')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror

    <br>

    <label>
        Puja:
        <br>
        <input type="text" name="puja" value="{{old('puja')}}">
    </label>

    @error('puja')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror

    <br>

    <label>
        Precio:
        <br>
        <input type="text" name="precio" value="{{old('precio')}}">
    </label>

    @error('precio')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror

    <br>

    <label>
        Fecha límite:
        <br>
        <input type="datetime-local" name="fecha_limite" value="{{old('fecha_limite')}}">
    </label>


    @error('fecha_limite')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror

    <br>

    <button type="submit">Crear subasta</button>
    </form>
@endsection