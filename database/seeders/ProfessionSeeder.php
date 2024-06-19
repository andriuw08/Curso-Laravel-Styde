<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Asi hacemos que se desactiven las revisiones de clavez foraneas para que se puedan limpiar las tablas de manera correcta 
        DB::table('profession')->truncate(); // Con el metodo truncate hacemos que cada vez que se ejecute el seeder se borren las tablas antes de llenarlas, asi evitamos que se dupliquen los datos
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Asi volvemos a activar la revision de claves foraneas

        DB::table('professions')->insert([
            'title' => 'Desarrollador Back'
        ]);
    }
}
