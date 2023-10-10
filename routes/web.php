<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProducategoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('home',HomeController::class);
Route::resource('cliente',ClienteController::class);
Route::resource('producto',ProductoController::class);
Route::resource('pedido',PedidoController::class);
Route::resource('categoria',CategoriaController::class);
Route::resource('producatego',ProducategoController::class);

Route::view('/',"home");

