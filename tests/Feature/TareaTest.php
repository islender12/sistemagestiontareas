<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Events\NewTareaAsignada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TareaTest extends TestCase
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

    public function test_listadotareas(): void
    {
        $this->withExceptionHandling();
        $response = $this->autenticate()->get('listado_tareas');
        $response->assertStatus(200);
        $this->assertArrayHasKey('tareas', $response->json());
    }

    public function test_asignar_tarea_usuario(): void
    {
        $this->withExceptionHandling();

        // Creamos el Event fake (para disparar el evento)
        Event::fake();
        // Crear un usuario y una tarea
        $usuario = User::factory()->create();
        $proyecto = Proyecto::factory()->create();

        $tarea = Tarea::create([
            'nombre' => 'Crear una interfaz de usuario para el panel de control de TaskMaster',
            'descripcion' => 'Desarrollar una Interfaz Amigable que brinde una buena experiencia de usuario',
            'fecha_asignacion' => date('2023-03-25'),
            'fecha_vencimiento' => date('2023-04-10'),
            'user_id' => $usuario->id,
            'proyecto_id' => $proyecto->id
        ]);

        // Hacemos la Solicitud Post
        $response = $this->autenticate()->post('asignar_tarea_usuario', [
            'usuario' => $usuario->id,
            'tarea' => $tarea->id
        ]);

        // Verificamos que el status es el correcto
        $response->assertStatus(201);

        // Verificamos que se le asigno al usuario la tarea
        $this->assertTrue($usuario->tareas_asignadas()->get()->contains($tarea));

        // Verificamos que Disparamos el Evento
        Event::assertDispatched(NewTareaAsignada::class);
    }

    public function test_create_tarea(): void
    {
        $this->withExceptionHandling();

        $response = $this->autenticate()->get('tareas/create');

        $response->assertStatus(200);

        // Verificamos que la vista tenga una variable llamada 'proyectos'.
        $response->assertViewHas('proyectos');
    }

    public function test_store_tareas()
    {
        $this->withExceptionHandling();
        $proyecto = Proyecto::factory()->create();

        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);

        $response = $this->actingAs($user);
        $user = Auth::user();
        $response->post('tareas', [
            'nombre' => 'Crear una interfaz de usuario para el panel de control de TaskMaster',
            'descripcion' => 'Desarrollar una Interfaz Amigable que brinde una buena experiencia de usuario',
            'fecha_asignacion' => date('2023-03-25'),
            'fecha_vencimiento' => date('2023-04-10'),
            'user_id' => $user->id,
            'proyecto_id' => $proyecto->id
        ])->assertSessionHas('status', 'Tarea Creada Exitosamente');

        // Usamos un status 302 
    }

    public function test_destroy_tareas(): void
    {
        $this->withoutExceptionHandling();
        $proyecto = Proyecto::factory()->create();
        $response = $this->autenticate();
        $user = Auth::user();

        $tarea = Tarea::create([
            'nombre' => 'Crear una interfaz de usuario para el panel de control de TaskMaster',
            'descripcion' => 'Desarrollar una Interfaz Amigable que brinde una buena experiencia de usuario',
            'fecha_asignacion' => date('2023-03-25'),
            'fecha_vencimiento' => date('2023-04-10'),
            'user_id' => $user->id,
            'proyecto_id' => $proyecto->id
        ]);

        // Probamos Eliminar la tarea y si nos regresa un status 200
        $response->delete(route('tareas.destroy', $tarea))->assertStatus(200);

        // Verificamos que fue eliminada de la base de datos
        $this->assertDatabaseMissing('tareas', ['id' => $tarea->id]);
    }
}
