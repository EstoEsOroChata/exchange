@extends('layouts.plantilla')

@section('title','Contáctanos')

@section('content')

    <h1>Déjanos tu opinión</h1>

    <form action="{{route('contacto.store')}}" method="POST">

        @csrf

        <label>
            Nombre:
            <br>
            <input type="text" name="nombre" value="{{old('nombre')}}">
        </label>

        <br>

        @error('nombre')
            <strong>{{$message}}</strong>
            <br>
        @enderror

        <br>

        <label>
            Correo:
            <br>
            <input type="text" name="correo" value="{{old('correo')}}">
        </label>

        <br>

        @error('correo')
            <strong>{{$message}}</strong>
            <br>
        @enderror

        <br>

        <label>
            Mensaje:
            <br>
            <textarea name="mensaje" rows="5" value="{{old('mensaje')}}"></textarea>
        </label>

        <br>

        @error('mensaje')
            <strong>{{$message}}</strong>
            <br>
        @enderror

        <br>

        <button type="submit">
            Enviar mensaje
        </button>

        <br>
    </form>

    @if (session('info'))

        <script>
        alert("{{session('info')}}")
        </script>
        
    @endif
@endsection