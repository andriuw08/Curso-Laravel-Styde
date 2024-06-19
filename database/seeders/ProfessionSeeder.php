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
        DB::table('professions')->insert([
            'title' => 'Desarrollador Back'
        ]);

        DB::table('professions')->insert([
            'title' => 'Desarrollador Front'
        ]);

        DB::table('professions')->insert([
            'title' => 'Desarrollador Full Stack'
        ]);

        DB::table('professions')->insert([
            'title' => 'Desarrollador de Software'
        ]);
    }
}
