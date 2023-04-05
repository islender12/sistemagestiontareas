<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_asignacion' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_vencimiento' => $this->faker->dateTimeBetween('now', '+3 months'),
            'user_id' => 11,
            'proyecto_id' => rand(1,10)
        ];
    }
}
