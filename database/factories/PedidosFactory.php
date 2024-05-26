<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuarios; //  modelo Usuario
use App\Models\Pedidos;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Pedidos::class; //indica que la fábrica se usa para crear instancias del modelo

    public function definition(): array
    {
        // obtiene el id de usuarios existentes y guarda en array
        $idUsuario = Usuarios::pluck('id')->toArray();// pluck solo obtiene los datos de col id de la tabla
        
        return [
            //atributos de la tabla pedidos

            'user_id' => function () use ($idUsuario) {
                return $idUsuario[array_rand($idUsuario)];// selecciona un id de usuarios almacenado en idUsuario
            },
            'product' => $this->faker->sentence,
            'quantity' => $this->faker->randomDigitNotNull, //Numero entre 1 y 9
            'total' => $this->faker->randomFloat(2, 0, 1000),// numero entre 0 y 1000 con 2 decimales
        ];
    }
}
