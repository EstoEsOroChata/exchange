@extends('layouts.plantilla')

@section('title','Subasta de ' . $subasta->name)

@section('content')
    <h1>Editando subasta de: {{$subasta->name}}</h1>
    <form action="{{route('subastas.update', $subasta)}}" method="POST">
        <a href="{{route('subastas.index')}}">Volver a subastas</a>

    @csrf
    @method('put')

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

    <button type="submit">Guardar cambios</button>
    </form>
@endsection