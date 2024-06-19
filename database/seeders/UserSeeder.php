<?php

namespace Database\Seeders;

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
        $professionId = DB::table('professions') // De esta manera obtenemos el id de la profesion, ya que es un valor que viene enlazado con la tabla de profesiones la manera de obtenerlo y darle valor es diferente
            ->where('title', 'Desarrollador Back')
            ->value('id');

        DB::table('users')->insert([
            'name' => 'Andriuw Yepez',
            'email' => 'andriuw.yepez@gmail.com',
            'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
            'professions_id' => $professionId
        ]);
    }
}
