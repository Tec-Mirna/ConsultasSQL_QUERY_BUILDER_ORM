<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuarios; 
use App\Models\Pedidos;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        // utiliza la fábrica del modelo Usuarios para generar los registros y almacenarlos en la variable
        $usuarios = Usuarios::factory(5)->create();
      
       
         // por cada usuario creado, y almacenado en la variable se crea un pedido y se le asigna el id
         foreach ($usuarios as $usuario) {
            Pedidos::factory()->create(['user_id' => $usuario->id]);
        }



    }
}
