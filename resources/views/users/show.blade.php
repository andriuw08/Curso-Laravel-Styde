@extends('layout')
@section('title', "Usuario {$id}")
@section('content')
    <h1> Usuario #{{ $id }} </h1>
    Este es el usuario con el id: {{ $id }}
@endsection