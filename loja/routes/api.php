<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(static function(){

    Route::get('/vendedores', [App\Http\Controllers\VendedoresApiController::class, 'index']);//get para obter informações; chama o método index da api controller
    Route::post('/vendedores', [App\Http\Controllers\VendedoresApiController::class, 'store']);
    Route::delete('/vendedores/{id}', [App\Http\Controllers\VendedoresApiController::class, 'destroy']);
    Route::get('/vendedores/{id}', [App\Http\Controllers\VendedoresApiController::class, 'show']);
    Route::put('/vendedores/{id}', [App\Http\Controllers\VendedoresApiController::class, 'update']);

    Route::get('/clientes', [App\Http\Controllers\ClientesApiController::class, 'index']);
    Route::post('/clientes', [App\Http\Controllers\ClientesApiController::class, 'store']);
    Route::delete('/clientes/{id}', [App\Http\Controllers\ClientesApiController::class, 'destroy']);
    Route::get('/clientes/{id}', [App\Http\Controllers\ClientesApiController::class, 'show']);
    Route::put('/clientes/{id}', [App\Http\Controllers\ClientesApiController::class, 'update']);

    Route::get('/produtos', [App\Http\Controllers\ProdutosApiController::class, 'index']);
    Route::post('/produtos', [App\Http\Controllers\ProdutosApiController::class, 'store']);
    Route::delete('/produtos/{id}', [App\Http\Controllers\ProdutosApiController::class, 'destroy']);
    Route::get('/produtos/{id}', [App\Http\Controllers\ProdutosApiController::class, 'show']);
    Route::put('/produtos/{id}', [App\Http\Controllers\ProdutosApiController::class, 'update']);
});//prefixo para todos os endpoints
