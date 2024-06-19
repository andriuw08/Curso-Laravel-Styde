@extends('layout')
@section('title', "Usuario {$user->id}")
@section('content')
    <h1> Usuario #{{ $user->id }} </h1>
    Este es el usuario con el id: {{ $user->id }}
@endsection