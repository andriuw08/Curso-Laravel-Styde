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

        // DB::table('users')->insert([
        //     'name' => 'Andriuw Yepez',
        //     'email' => 'andriuw.yepez@gmail.com',
        //     'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
        //     'professions_id' => $professionId
        // ]);
    }
}
