<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidosController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ejercicio1', [PedidosController::class, 'getPedidosByUserId']);
Route::get('/ejercicio2', [PedidosController::class, 'getPedidosDetalles']);
Route::get('/ejercicio3', [PedidosController::class, 'getPedidosRango']);
Route::get('/ejercicio4', [PedidosController::class, 'getUsuariosConR']);
Route::get('/ejercicio5', [PedidosController::class, 'calcularTotalPedidosUsuario']);
Route::get('/ejercicio6', [PedidosController::class, 'getAll']);
Route::get('/ejercicio7', [PedidosController::class, 'sumTotal']);
Route::get('/ejercicio8', [PedidosController::class, 'pedidoEconomico']);
Route::get('/ejercicio9', [PedidosController::class, 'pedidosAgrupadosPorUsuario']);


