<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{
    /** @test */
    function example()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios') // Este hace que comprueba que si cuando se carga la vista se vea el texto usuarios
            ->assertSee('Tommy')
            ->assertSee('Joel');
    }

    /** @test */
    function users_list_is_empty()
    {
        $this->get('/usuarios?empty')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados'); // Este hace que comprueba que si cuando se carga la vista se vea el texto usuarios
    }
    

    /** @test */
    function example_id()
    {
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Este es el usuario con el id: 5');
    }

    /** @test */
    function create_user()
    {
        $this->withoutExceptionHandling(); // este metodo funciona para poder localizar un error en la consola
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Este es el usuario con el id: 5');
    }

}
