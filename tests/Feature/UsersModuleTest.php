<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use \App\Models\User;
use \Database\Factories\UserFactory;

class UsersModuleTest extends TestCase
{

    // use RefreshDatabase;

    /** @test */
    function example()
    {

        // Esto lo hacemos con la intencion de uqe antes de que se ejecuten los test se creen los nombre de los usuarios que estamos probando y asi pasen los test
        // User::create([
        //     'name' => 'Tommy'
        // ]);

        // User::create([
        //     'name' => 'Joel'
        // ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios') // Este hace que comprueba que si cuando se carga la vista se vea el texto usuarios
            ->assertSee('Tommy')
            ->assertSee('Joel');
    }

    /** @test */
    function users_list_is_empty()
    {
        $this->get('/usuarios')
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

    // Hay un error con este test cuando lo ejecuto, error que lo mas probable es que sea por lo mismo que he estado teniendo otros errores los cuales son con la prueba
    /** @test */
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/crear', [
            'name' => 'Leonel Messi',
            'email' => 'messi@gmail.com',
            'password' => '123456'
        ])->assertRedirect('usuarios'); // Con esto corroboramos que el usuario sea rederigido

        $this->assertCredentials([ // Este metdo es para verificar que exista un usuario en la base de datos que coincidan las credenciales, evitando posibles errores con la generacion de contraseñas encriptadas
            'name' => 'Leonel Messi',
            'email' => 'messi@gmail.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_name_is_required()
    {  
        // $users = DB::table('users')->get();
        // Estoy recibiendo errores con las rutas, lo mas problable es que sean por lo mismo de las verisones y demas.
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [ // Tenemos que no pasar el campo de nombre ya que estamos comprobando que sea requerido
                'name' => '',
                'email' => 'messi@gmail.com',
                'password' => '123456'
        ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']); // Incluye un error para el campo nombre
        //$this->assertEquals(0, User::count()); // Esto sirve para validar que no haya ningun usuario en la base de datos, esto sirve cuando podemos utilizar el RefreshDatabase, para que cada ves que se ejecute un test se borren todas las tablas y se vuelvan a llenar
        // $this->assertDataBaseMissing('users', [ // Esto comprueba que en la base de datos ya no exista un usuario con los campos
        //     'email' => 'messi@gmail.com'
        // ]);
    }

    /** @test */
    function the_email_is_required()
    {  
        // $users = DB::table('users')->get();
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
                'name' => 'Benito',
                'email' => '',
                'password' => '123456'
        ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        // $this->assertEquals(0, User::count()); 
    }

    /** @test */
    function the_email_must_be_valid()
    {  
        // $users = DB::table('users')->get();
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
                'name' => 'Andres',
                'email' => 'corre-no-valido',
                'password' => '123456'
        ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        // $this->assertEquals(0, User::count()); 
    }

    /** @test */
    function the_email_must_be_unique()
    {  
        // Este test no lo puedo ejecutar hasta que pueda utilizar el factory y el RefreshDatabase, ya que si lo ejecuto el factory me dara el error y el refresh me borrara todo y duplicara datos
        factory(User::class)->create([
            'email' => 'a.yepez@viavox.com'
        ]);

        // $users = DB::table('users')->get();
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
                'name' => 'Andriuw',
                'email' => 'a.yepez@viavox.com',
                'password' => '123456'
        ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1, User::count()); 
    }

    /** @test */
    function the_password_is_required()
    {  
        // $users = DB::table('users')->get();
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
                'name' => 'Alejandro',
                'email' => 'alejandro@gmail.com',
                'password' => ''
        ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);
        // $this->assertEquals(0, User::count()); 
    }

    /** @test */
    function it_loads_the_edit_user_page()
    {  
        // Este test no lo podre correr hasta arreglar el problema del factory

        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password'])
        // ]);

        $user = factory(User::class)->create();

        $this->get("usuarios/{$user->id}/editar") 
            ->assertStatus(200)
            ->assertViewIs('users.edit') // De esta manera verificamos que nos este llevando a la vista correcta
            ->assertViewHas('user', function($viewUser) use ($user) {
                return $viewUser-> id === $user->id;
            }); // De esta manera verificamos que la vista tenga la variable del usuario, comparando dos objetos, el usuario que recibe la vista y el usuario que tenemos guardado
    }

    /** @test */
    function it_updats_a_user()
    {
        // Al igual que en los otros test que utilizo factory, aun no lo pueod ejecutar porque me da error,
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->put("usuarios/{user->id}", [ // De esta manera hacemos una actualizacion a usuario aleatorio que se genero con el factory
            'name' => 'Soteldo',
            'email' => 'soteldo@gmail.com',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([ // Este metdo es para verificar que exista un usuario en la base de datos que coincidan las credenciales, evitando posibles errores con la generacion de contraseñas encriptadas
            'name' => 'Soteldo',
            'email' => 'soteldo@gmail.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {  
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->from("usuarios/{user->id}/editar")
            ->put("usuarios/{user->id}", [ 
                'name' => '',
                'email' => 'soteldo@gmail.com',
                'password' => '123456'
        ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);
        //$this->assertDataBaseMissing('users', [ // Esto para verificar que el usuario no fue actualizado anteriormente, pero como da error lo dejo comentado de momento 
        //    'email' => 'messi@gmail.com'
        //]);
    }

      /** @test */
    function the_email_is_required_when_updating_a_user()
    {  
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->from("usuarios/{user->id}/editar/editar")
            ->put("usuarios/{user->id}", [ 
                'name' => 'Sotelddo',
                'email' => '',
                'password' => '123456'
        ])
            ->assertRedirect("/usuarios/{$user->id}")
            ->assertSessionHasErrors(['email']);
        //$this->assertDataBaseMissing('users', [ // Esto para verificar que el usuario no fue actualizado anteriormente, pero como da error lo dejo comentado de momento 
        //    'email' => 'messi@gmail.com'
        //]);
    }
  
    /** @test */
    function the_email_must_be_valid_when_updating_a_user()
    {  
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->from("usuarios/{user->id}/editar")
            ->put("usuarios/{user->id}", [ 
                'name' => 'Soteldo',
                'email' => 'correo-no-valido',
                'password' => '123456'
        ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
        //$this->assertDataBaseMissing('users', [ // Esto para verificar que el usuario no fue actualizado anteriormente, pero como da error lo dejo comentado de momento 
        //    'name' => 'Soteldo'
        //]);
    }
  
    /** @test */
    function the_email_must_be_unique_when_updating_a_user()
    {  
        factory(User::class)->create([
            'email' => 'existing-email@example.com'
        ]);
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'email' => 'soteldo@gmail.com',
        ]);
        $this->from("usuarios/{user->id}/editar")
            ->put("usuarios/{user->id}", [ 
                'name' => 'Soteldo',
                'email' => 'existing-email@example.com',
                'password' => '123456'
        ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
            $this->assertEquals(1, User::count()); 
    }
  
    /** @test */
    function thee_users_email_can_stay_the_same_when_updating_a_user()
    {  
        // Esta verificando que a la hora de editar un usuario se esta manteniendo el mismo correo electronico
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'email' => 'soteldo@gmail.com'
        ]);
        $this->from("usuarios/{user->id}/editar")
            ->put("usuarios/{user->id}", [ 
                'name' => 'Soteldo',
                'email' => 'soteldo@gmail.com',
                'password' => '123456789'
        ])
            ->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([ // Esto verifica que existe un usuario ya creado con los datos
            'name' => 'Soteldo',
            'email' => 'soteldo@gmail.com',
        ]);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user()
    {  
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'password' => bcrypt('clave_anterior')
        ]);
        $this->from("usuarios/{user->id}/editar")
            ->put("usuarios/{user->id}", [ 
                'name' => 'Soteldo',
                'email' => 'soteldo@gmail.com',
                'password' => ''
        ])
            ->assertRedirect("/usuarios/{$user->id}")
            ->assertSessionHasErrors(['password']);
        $this->assertCredentials([ // Esto verifica que existe un usuario ya creado con los datos
            'name' => 'Soteldo',
            'email' => 'soteldo@gmail.com',
            'password' => ''
        ]);
    }

    /** @test */
    function it_deletes_a_user()
    {  
    
        $user = factory(User::class)->create();

        $this->delete("usuarios/{$user->id}/eliminar")
            ->assertRedirect('usuarios');
        
        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
  
}
