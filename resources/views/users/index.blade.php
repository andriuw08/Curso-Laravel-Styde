<!-- De esta manera importamos el archivo que queramos para poder utilizar el contenido, teniendo siempre en cuenta que este en la carpeta views  
    Los include y las views del public son los componentes por asi decirlo
-->
@extends('layout')

{{-- Con el extend le indicamos que es parte del layout y va a ir en la parte en la que esta el content --}}
@section('content')
    <h1> {{ $title }} </h1>
    <ul>
        @forelse ($users as $user)
            <li> {{ $user }} </li>
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


    <!-- ESTA ES LA MANERA DE HACERLO CON PHP NATIVO 
    <ul>
        De esta manera recorremos el arreglo de usuarios que hemos creado en las rutas, para asi poder mostrarlo en la vista como una lista
        <?php foreach($users as $user): ?>
            <li> <?php echo e($user) ?> </li>
            el metodo e es muy importante para que php ignore el codigo html o js que pueda llegar a estar en el arreglo, esto con el fin de que si alguien llega a crear un usuario con codigo js o html se muestre como un string
        <?php endforeach ?>
    </ul> -->
    <!-- TAMBIEN SE PUEDE USAR UN UNLESS EN LUGAR DE UN CONDICIONAL
            El unless funciona como un condicional pero inversio, es decir, "A menos que la lista de usuarios este vacia, mostrare el listado de usuarios, sino el arreglo de usuarios"
    @unless(empty($users))
        <ul>
            @foreach($users as $user)
                <li> {{ $user }} </li>
            @endforeach        
        </ul>
    @else
        <p> No hay usuarios registrados </p>
    @endunless   -->

    <!-- TAMBIEN SE PUEDE USAR UN EMPTY EN LUGAR DE UN CONDICIONAL
            El empty se usa para verificar si una variable esta vacia
    @empty($users)
        <p> No hay usuarios registrados </p>
        @else
        <ul>
            @foreach($users as $user)
                <li> {{ $user }} </li>
            @endforeach        
        </ul>
    @endempty   -->