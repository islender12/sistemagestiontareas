<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_listado_usuario(): void
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('listado_usuarios');
        $response->assertStatus(200);
        $this->assertArrayHasKey('users', $response->json());
    }
}
