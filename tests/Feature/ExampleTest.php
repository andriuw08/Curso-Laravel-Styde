<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_example()
    {
        $response = $this->get('/'); // peticion al home

        $response->assertStatus(200); // espera un Ok como respuesta
    }
}

// IMPORTANTE crear un alias para poder ejecutar los test mas sencillo
//      alias t=vendor/bin/phpunit 
// Asi creamos una nueva prueba
//      php artisan make:test UsersModuleTest
