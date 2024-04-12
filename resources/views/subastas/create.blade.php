@extends('layouts.plantilla')

@section('title','Subastas create')

@section('content')
    <h1>Aquí puedes crear una subasta</h1>
    <a href="{{route('subastas.index')}}">Volver a subastas</a>

    <form action="{{route('subastas.store')}}" method="POST">

    @csrf

    <br>
    
    <select name="producto_id">
        <option value="">Selecciona un producto</option>
        @foreach ($productos as $producto)
            <option value="{{$producto->id}}">{{$producto->name}}</option>
        @endforeach
    </select>

    {{-- @error('name')
    <br>
        <span>{{$message}}</span>
        <br>
    @enderror --}}

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
        Duración de la subasta:
        <br>
        <select name="duracion_subasta">
            <option value="12">12 horas</option>
            <option value="24">24 horas</option>
            <option value="48">48 horas</option>
        </select>
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