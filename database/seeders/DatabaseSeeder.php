<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // dd(ProfessionSeeder::class);
        // \App\Models\User::factory(10)->create();
        $this->truncateTables([
            'users',
            'professions'
        ]);
        
        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
    }

    protected function truncateTables(array $tables) { // Asi creamos un metodo para para poder borrar las tablas de manera mas rapida y eficiente
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Asi hacemos que se desactiven las revisiones de clavez foraneas para que se puedan limpiar las tablas de manera correcta 
        foreach($tables as $table) {
            DB::table($table)->truncate(); // Con el metodo truncate hacemos que cada vez que se ejecute el seeder se borren las tablas antes de llenarlas, asi evitamos que se dupliquen los datos
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Asi volvemos a activar la revision de claves foraneas
    }
}
