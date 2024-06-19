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
        DB::table('users')->insert([
            'name' => 'Andriuw Yepez',
            'email' => 'andriuw.yepez@gmail.com',
            'password' => bcrypt('laravel'), // De esta manera generamos una contraseña encriptada con laravel
        ]);
    }
}
