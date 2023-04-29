<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProyectoTest extends TestCase
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

    public function autenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);

        $response = $this->actingAs($user);

        return $response;
    }


    public function test_proyecto(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->autenticate();

        // Verificamos si responde la ruta
        // estamos mandando la vista correcta y su status es 200
        $response->get('/proyectos')->assertViewIs('Admin.Proyecto.index')
            ->assertStatus(200);
    }

    public function test_all_projects(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->autenticate()->get('allprojects');
        $response->assertStatus(200);
        $this->assertArrayHasKey('proyectos', $response->json());
    }


    // Test store para almacenamiento de proyectos en la base de datos
    public function test_proyecto_store(): void
    {
        $this->withoutExceptionHandling();

        $data = [
            'nombre' => 'Proyecto de Prueba',
            'descripcion' => 'Este es un  proyecto para poner a prueba a los desarrolladores'
        ];

        $response = $this->autenticate()->post('proyectos', $data);

        // Verificamos si se almacena los proyectos en la tabla proyectos de la DB
        $this->assertDatabaseHas('proyectos', $data);
        $this->assertArrayHasKey('mensaje', $response->json());
        $response->assertStatus(201);
    }
}
