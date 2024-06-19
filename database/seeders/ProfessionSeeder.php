<?php

namespace Database\Seeders;

use \App\Models\Profession;
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
        // De esta manera ingresamos codigo directamente con sentencias sql, el ? en el value nos indica que es un parametro dinamico, haciendo asi que en los corchetes podamos pasar el valor que queremos colocar
        // DB::insert('INSERT INTO professions (title) VALUES (?)', ['Desarrollador back-end']);

        //Otra manera de hacerlo es que en lugar de un ? utilicemos con dos puntos y el parametro directamente, asi podemos pasar varios valores con una sola consulta
        // DB::insert('INSERT INTO professions (title) VALUES (:title)', [
        //     'title' => 'Desarrollador back-end'
        // ]);


        // Crear con una consulta 
        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador Back'
        // ]);

        // Crear con un modelo
        Profession::create([ // De esta manera llamamos al modelo
            'title' => 'Desarrollador back-end',
        ]);

        Profession::create([
            'title' => 'Desarrollador frond-end',
        ]);

        Profession::create([
            'title' => 'Desarrollador web',
        ]);

        // factory(Profession::class)->times(17)->create();
    }
}
