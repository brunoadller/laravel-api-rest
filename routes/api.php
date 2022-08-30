<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//PRIMEIRO PASSO PRA INSTALAR O SANCTUM
//php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
//chamando a função de cadastro do usuario
Route::post('/register',[AuthController::class, 'register']);

//ROTA SANCTUM PARA PROTEGER OS DADOS QUE SÃO MANIPULADOS
//fica protetgido e só terá acesso quem estiver logado em sua conta
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/products',[ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});