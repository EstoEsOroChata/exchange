@extends('layouts.plantilla')

@section('title','Subastas edit')

@section('content')
    <h1>Aquí puedes editar una subasta</h1>
    {{-- <a href="{{route('subastas.show')}}">Volver a subastas</a> --}}
    <form action="{{route('subastas.update', $subasta)}}" method="POST">

    @csrf
    @method('put')

    <label>
        Nombre:
        <br>
        <input type="text" name="nombre" value="{{ old('nombre', $subasta->nombre)}}">
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
        <input type="text" name="cantidad" value="{{ old('cantidad', $subasta->cantidad)}}">
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
        <input type="text" name="puja" value="{{ old('puja', $subasta->puja)}}">
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
        <input type="text" name="precio" value="{{ old('precio', $subasta->precio)}}">
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
        <input type="datetime-local" name="fecha_limite" value="{{ old('fecha_limite', $subasta->fecha_limite)}}">
    </label>

    @error('fecha_limite')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror

    <br>

    <button type="submit">Guardar cambios</button>
    </form>
@endsection