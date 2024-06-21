@extends('layout')
@section('title', "Usuario {$user->id}")
@section('content')
    <h1> Usuario #{{ $user->id }} </h1>
    <span> Nombre del usuario: {{ $user->name }} </span> <br>
    <span> Correo electronico: {{ $user->email }} </span> <br>
    <a href="{{ url('/usuarios') }}"> Volver </a>
@endsection