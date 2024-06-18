<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    public function welcomes_users_with_nickname()
    {
        $this->get('saludo/Andriuw/yepez')
            ->assertStatus(200)
            ->assertSee('Bienvenido Andriuw, tu apodo es yepez');
    }

    /** @test */
    public function welcomes_users_without_nickname()
    {
        $this->get('saludo/Andriuw')
            ->assertStatus(200)
            ->assertSee('Bienvenido Andriuw');
    }
}
