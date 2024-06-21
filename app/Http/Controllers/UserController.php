<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{
    public function index() {
        return 'Usuarios';
    }

    public function show($id) {
        return "Este es el usuario con el id: {$id}";
    }

    public function create() {
        return view('users.create');
    }

    public function store() {

        // de esta manera obtenemos los datos reales de la peticion
        $data = request()->validate([
            'name' => 'required', // De esta manera validamos que el campo sea obligatorio
            'email' => ['required', 'email', 'unique:users,email'], // De esta manera podemos haver varias validaciones a un solo campo, el email sirve para que laravel revise que cumple con la sintaxis de un email y con unique validamos que sea un campo unico, el primer paraetro en la table en la que vamos a buscar y el segundo la columna
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio'
        ]);

        User::create([
            // 'name' => 'Leonel Messi',
            // 'email' => 'messi@gmail.com',
            // 'password' => bcrypt(123456)
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios'); // De esta manera redirigimos al usuario a una vista especifica
    }

    public function edit(User $user) {
        return view('users.edit', [
            'user' => $user
        ]);   
    }

    public function update(User $user) {

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id, // De esta manera permitimos aplicar varias reglas al mismo tiempo, entre ellas que sea un campo unico pero que tambien pueda ser igual a como se esta recibiendo
            'password' => '',
        ]);

        if ($data['password'] != null) { // Verifica  si la con ula
            $data['password'] = bcrypt($data['password']); // si no es nula la encripta
        } else {
            unset($data['password']); // Si si es nula la  borra del arreglo de usuarios antes de actualizar
        }

        // $data['password'] = bcrypt($data['password']); // Esto es para encriptar la contraseña, sino dara error al intentar actualizar

        $user->update($data); // Este es un metodo nativo de laravel para actualizar

        return redirect("usuarios/show", [
            'user' => $user
        ]);
    }

    public function destroy(User $user) {

        $user->delete();

        return redirect("/usuarios");
    }
}
