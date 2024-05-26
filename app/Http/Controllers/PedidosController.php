<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Para usar Query Builder

class PedidosController extends Controller
{
    // 1 Recupera todos los pedidos asociados al usuario con ID 2
    // Eloquent ORM
    public function getPedidosByUserId()
    {
        $userId = 66;
         // Obtiene todos los pedidos del usuario con ID 66
       $pedidos = Pedidos::where('user_id', $userId)->get();

       // Retorna los pedidos 
       return $pedidos;
    }



    //2 Obtén la información detallada de los pedidos, incluyendo el nombre y correo electrónico de los usuario
    // Query Builder 
    public function getPedidosDetalles(){

    
     $detallesPedidos = DB::TABLE('pedidos')
     // JOIN para unir tabla pedidos y usuarios
     ->JOIN('usuarios', 'pedidos.user_id', '=', 'usuarios.id')
     ->SELECT('pedidos.id as id_pedido' , 'pedidos.product', 'pedidos.quantity', 'pedidos.total',  'usuarios.name as user_name', 'usuarios.email as user_email')
     ->GET();

   
    return $detallesPedidos;
  }



    // 3 Recupera todos los pedidos cuyo total esté en el rango de $100 a $250
   // Query Builder
    public function getPedidosRango(){
  
    $pedidosEnRango = DB::TABLE('pedidos')
        ->WHEREBETWEEN('total', [100, 250]) //whereBetween permite especificar un rango numérico
        ->GET();

    return $pedidosEnRango;
  }



    // 4 Encuentra todos los usuarios cuyos nombres comiencen con la letra "R
    // Query Builder
    public function getUsuariosConR()
    {
        $usuariosConR = DB::TABLE('usuarios')
            ->where('name', 'LIKE', 'R%')
            ->get();
    
        return $usuariosConR;
    }




    //5 Calcula el total de registros en la tabla de pedidos para el usuario con ID 5.
   // Query Builder
   public function calcularTotalPedidosUsuario(){

    $user = 66; // id 66 porque no existe el 5 en mi base de datos
    $totalPedidosUsuario = DB::TABLE('pedidos')
        ->where('user_id', $user)
        ->count();

    return $totalPedidosUsuario;
   }



   // 6 Recupera todos los pedidos junto con la información de los usuarios, ordenándolos de forma descendente según el total del pedido
   // Query Builder
   public function getAll(){

      $pedidosUsuarios = DB::TABLE('pedidos') 
      ->JOIN('usuarios', 'pedidos.user_id', '=', 'usuarios.id') // unir las dos tablas
      ->SELECT('pedidos.id', 'pedidos.product', 'pedidos.quantity', 'pedidos.total', 'usuarios.name as user_name', 'usuarios.phone', 'usuarios.email as user_email') // Columnas que deseo traer
      ->ORDERBY('pedidos.total', 'desc') // ordernar descendentemente
      ->GET(); // Obtener los resultados
    // pedidos.* para seleccionar todas las columnas de tabla pedidos
      return $pedidosUsuarios;

   }



   //7  Obtén la suma total del campo "total" en la tabla de pedidos.
    // Eloquent ORM
   public function sumTotal(){

      // Calcula la suma total del campo "total" en la tabla de pedidos
      $sumaTotal = Pedidos::sum('total');

      // Retorna la suma total en formato JSON
      return response()->json([
          'status' => true,
          'message' => 'La suma de todos los valores del campo total',
          'total' => $sumaTotal
      ]);
   }


   // 8 Encuentra el pedido más económico, junto con el nombre del usuario asociado.
    // Query Builder
   public function pedidoEconomico(){
    $economico = DB::TABLE('pedidos')
    ->JOIN('usuarios', 'pedidos.user_id', '=', 'usuarios.id') 
    ->SELECT('pedidos.id as id_pedido', 'pedidos.product', 'pedidos.total', 'usuarios.name as user_name') // Seleccionar columnas que deseo extraer de la base de datos
    ->ORDERBY('pedidos.total', 'asc') //Ordeno ascendentemente
    ->FIRST(); //Muestro el primer resultado después de ordernar ascendente.

    return $economico;
   }


   // 9 Obtén el producto, la cantidad y el total de cada pedido, agrupándolos por usuario.
   // Eloquent ORM
   public function pedidosAgrupadosPorUsuario(){
    $usuarios = Usuarios::with(['pedidos' => function ($query) {
        $query->SELECT('user_id', 'product', 'quantity', 'total'); // seleccionar coluumnas
    }
    ])->GET();

    return $usuarios;
}
}
