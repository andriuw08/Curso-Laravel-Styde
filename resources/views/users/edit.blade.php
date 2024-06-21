@extends('layout')
@section('title', "Editar Usuario")
@section('content')
    <h1> Editar Usuario </h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <span> Hay errores en el formulario </span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
        </div>
    @endif

    <form method="POST" action=" {{ url("/usuarios/{$user->id}") }} ">
        @method('PUT')
        @csrf

        <label for="name"> Nombre: </label>
        <input type="text" name="name" id="name" placeholder="Andriuw Yepez" value="{{ old('name', $user->name) }}"> {{-- El segundo argumento del old funciona para que cuando vayamosa a cargar la vista de editar se muestren los datos del usuario que ya esta precargado, en caso de que el primer argumento este vacio --}}
        @if ($errors->has('name'))
            <p> {{ $errors->firts('name') }} </p> 
        @endif 

        <label for="email"> Correro Electrónico: </label>
        <input type="email" name="email" id="email" placeholder="andriuw@examle.com" value="{{ old('email', $user->email) }}">

        <label for="password"> Contraseña: </label>
        <input type="text" name="password" id="password" placeholder="Mayor de 6 caracteres">
        
        <button type="submit"> Crear usuario </button>
    </form>

    <a href="{{ url('/usuarios') }}"> Volver </a>
@endsection