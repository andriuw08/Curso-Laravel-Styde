<?php

namespace Database\Seeders;

use \App\Models\User;
use \App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Esto se puede cambiar para hacerlo directamente con consultas sql
        // $professionId = DB::table('professions') // De esta manera obtenemos el id de la profesion, ya que es un valor que viene enlazado con la tabla de profesiones la manera de obtenerlo y darle valor es diferente
        //     ->where('title', 'Desarrollador Back')
        //     ->value('id');

        // Asi puedo consultar la base de datos pero usando el orm eloquent
        $professionId = Profession::where('title', 'Desarrollador back-end')->value('id');


        User::create([
            'name' => 'Andriuw Yepez',
            'email' => 'andriuw.yepez@gmail.com',
            'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
            'professions_id' => $professionId
        ]);

        User::create([
            'name' => 'Penny Piper',
            'email' => 'penny.piper@gmail.com',
            'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
            'professions_id' => $professionId
        ]);

        User::create([
            'name' => 'Raul Primo',
            'email' => 'raul.primo@gmail.com',
            'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
            'professions_id' => $professionId
        ]);

        User::create([
            'name' => 'Nita Oso',
            'email' => 'nita.oso@gmail.com',
            'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
            'professions_id' => $professionId
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Andriuw Yepez',
        //     'email' => 'andriuw.yepez@gmail.com',
        //     'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
        //     'professions_id' => $professionId
        // ]);

        // Asi lo creamos con el factory para poder generar varios usuarios aleatoriamente y asi mejorar las pruebas
        // factory(User::class)->created([
        //     'name' => 'Andriuw Yepez',
        //     'email' => 'andriuw.yepez@gmail.com',
        //     'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
        //     'professions_id' => $professionId
        // ]);

        // factory(User::class)->create([
        //     'profession_id' => $professionId
        // ]);

        // Comment::factory()->count(10)->create(); // De esta manera creamos registros con datos aleatorios, el segundo parametro es la cantidad de registros que vamos a crear
    }
}
