@extends('layouts.plantilla')

@section('title','Subasta de ' . $subasta->name)

@section('content')
    <h1>Editando subasta de: {{$subasta->name}}</h1>
    <form action="{{route('subastas.update', $subasta)}}" method="POST">

    @csrf
    @method('put')
    
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