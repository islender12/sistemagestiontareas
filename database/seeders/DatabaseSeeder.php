<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

       User::factory()->create([
            'name' => 'Islender',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678')
        ]);

        Permission::create([
            'nombre' => 'Asignar Tareas',
            'descripcion' => 'Permiso para asignar Tareas a Distintos Usuarios'
        ]);

        Proyecto::create([
            'nombre' => 'TaskMaster',
            'descripcion' => 'TaskMaster es un sistema de gestión de tareas diseñado para ayudar a las empresas y organizaciones a manejar de manera efectiva sus tareas diarias.'
        ]);

        Tarea::create([
            'nombre' => 'Crear una interfaz de usuario para el panel de control de TaskMaster',
            'descripcion' => 'Desarrollar una Interfaz Amigable que brinde una buena experiencia de usuario',
            'fecha_asignacion' => date('2023-03-25'),
            'fecha_vencimiento' => date('2023-04-10'),
            'user_id' => 11,
            'proyecto_id' => 1
        ]);
    }
}
