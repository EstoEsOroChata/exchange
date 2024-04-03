@extends('layouts.plantilla')

@section('title', 'Home')

@section('content')

<a href="{{route('iniciar-sesion')}}">Iniciar sesión</a>
<a href="{{route('registro')}}">Regístrate</a>

@endsection