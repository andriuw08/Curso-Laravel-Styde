<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', function () {
    if(request()->has('empty')){ // Esto verifica si el arreglo esta vacio, en caso de contener el elemento empty devolvera el arreglo vacio, en caso de que no devolvera el arreglo con los usuarios
        $users = [];
    } else {
        $users = [
            'Joel',
            'Ellie',
            'Tess',
            'Tommy',
            'Bill',
        ]; // De esta manera podeos ir creando informacion, en este caso un simple arreglo, se pueden hacer cosas mucho mas producidas que se veran depsues
    }


    return view('users.index', [
        'users' => $users, // De esta manera pasamos la variable de los usuarios a la vista
        'title' => 'Listado de usuarios'
        // Otra manera de pasar las variables seria con el metodo with
            // return view('users')
            //     ->with('users', $users)
            //     ->with('title', 'Listado de usuarios');
    ]);
});

Route::get('/usuarios/{id}', function ($id) {
    return view('users.show', [
        'id' => $id
    ]);
})->where('id', '[0-9]+'); // Con esto se puede crear una condicion para la ruta, haciendo que solo acepte un tipo de dato y cosas asi por el estilo, una expresion regular para una ruta basicamente

Route::get('/saludo/{name}/{nickname?}', function ($name, $nickname = null) {
    $name = ucfirst($name); // Con este metodo colocamos el name en mayusculas
    
    if($nickname) {
        return "Bienvenido {$name}, tu apodo es {$nickname}";
    } else {
        return "Bienvenido {$name}";
    }
});


// UTILIZANDO CONTROLADORES ME ESTA DANDO ERROR, SUPONGO QUE FALTA IMPORTAR O ALGO POR EL ESTILO, VER LUEGO
// Route::get('/usuarios', 'UserController@index'); // Asi hacemos que apunte a un controlador
// // el @idex indica el metodo del controlador con el cual queremos trabajar 


// Route::get('/usuarios/{id}', 'UserController@show')
//     ->where('id', '[0-9]+'); // Con esto se puede crear una condicion para la ruta, haciendo que solo acepte un tipo de dato y cosas asi por el estilo, una expresion regular para una ruta basicamente

// Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController@index');