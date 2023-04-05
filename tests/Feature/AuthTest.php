<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login(): void
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);
        // Nos Logueamos enviamos es token que genera laravel de sesion y los campos email y password
        $response = $this->withSession(['_token' => csrf_token()])
            ->post('login', [
                'email' => 'test@test.com',
                'password' => '12345678'
            ]);
        // Verificamos que al loguearnos nos redirecciona a la ruta home

        // El envia un status 302 pues esta redirigiendo a la ruta home
        $response->assertRedirect('home')->assertStatus(302);
    }

    public function test_failed_login(): void
    {
        // Creamos el usuario
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);
        // Ingresamos datos Incorrectos

        $response = $this->withSession(['_token' => csrf_token()])
            ->post('login', [
                'email' => 'test@test.com',
                'password' => '123142587'
            ]);
        $response->assertSessionHas('status', 'Credenciales Incorrectas');
        $response->assertRedirect('login');
    }

    public function test_logout(): void
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);
        $this->actingAs($user);

        $response = $this->get('/logout')->assertSee('login');
        // Verificamos que sea redirigido al login
        $response->assertRedirect('login');

        // Verificamos que el usuario tenga la sesion cerrada
        $this->assertGuest();
    }
}
