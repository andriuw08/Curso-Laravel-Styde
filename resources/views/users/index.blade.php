<!-- De esta manera importamos el archivo que queramos para poder utilizar el contenido, teniendo siempre en cuenta que este en la carpeta views  
    Los include y las views del public son los componentes por asi decirlo
-->
@extends('layout')

{{-- Con el extend le indicamos que es parte del layout y va a ir en la parte en la que esta el content --}}
@section('content')
    <h1> {{ $title }} </h1>

    <p>
        <a href="{{ url("/usuarios/nuevo") }}"> Nuevo Usuario </a>
    </p>

    <ul>
        @forelse ($users as $user)
            <li> 
                {{ $user->name }}, {{ $user->email }} 
                <a href="{{ url("/usuarios/$user->id") }}"> Ver detalles </a> {{-- De esta manera generamos una direccion url --}}
                <a href="{{ url("/usuarios/$user->id/editar") }}"> Editar Usuario </a>
                <form action=" {{ url("/usuarios/$user->id/eliminar") }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit"> Eliminar </button>
                </form>
            </li>
        @empty
            <li> No hay usuarios registrados </li>
        @endforelse
        </ul>
@endsection

@section('sidebar')
    {{-- Con el parent hacemos que se pueda personalizar un contenido sin la necesidad de modificar el mismo, sino mas bien agregandolo --}}
    @parent
    <h2> Barra lateral personalizada </h2>
@endsection