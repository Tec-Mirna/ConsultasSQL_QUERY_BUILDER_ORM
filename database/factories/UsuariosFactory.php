<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuarios; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

 //indica que la fábrica se usa para crear instancias del modelo Usuarios
    protected $model = Usuarios::class;

    public function definition(): array
    {
        return [
            // Atributos de la tabla Usuarios
             'name' => $this->faker->name,
             'email' => $this->faker->email,
             'phone' => $this->faker->phoneNumber, // phoneNumber: este método genera un número de teléfono 
        ];
    }
}
