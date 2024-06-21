@extends('layout')
@section('title', "Crear Usuario")
@section('content')
    <h1> Crear Usuario </h1>

    @if ($errors->any()) {{-- con el errors laravel nos devuelve automaticamente si hay cualquier tipo de error, y con la directiva any nos devuelve true en caso de que si y false en caso de que no --}}
        <div class="alert alert-danger">
            <span> Hay errores en el formulario </span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul> 
        </div>
    @endif

    <form method="POST" action=" {{ url('/usuarios/crear') }} ">
        {{-- { !! csrf_field() !! } --}} {{-- Este metodo sirve para que podamos generar un token ya que laravel suele proteger los metodos post --}}
        @csrf
        <label for="name"> Nombre: </label>
        <input type="text" name="name" id="name" placeholder="Andriuw Yepez" value="{{ old('name') }}"> {{-- Con el atributo alue y el old hacemos que si se recarga la pagina por algun tipo de error se mantenga el valor que estaba anteriormente, en este caso sienod le mimso valor --}}

        <label for="email"> Correro Electrónico: </label>
        <input type="email" name="email" id="email" placeholder="andriuw@examle.com" value="{{ old('email') }}">

        <label for="password"> Contraseña: </label>
        <input type="text" name="password" id="password" placeholder="Mayor de 6 caracteres">
        
        <button type="submit"> Crear usuario </button>
    </form>

    <a href="{{ url('/usuarios') }}"> Volver </a>
@endsection