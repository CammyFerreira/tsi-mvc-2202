<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\vendedoresController;
use \App\Http\Controllers\produtosController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/avisos', function () {

    $avisos = ['avisos' => [0 => ['data' => '06/09/2022', 'aviso' => 'Amanhã é feriado', 'exibir' => true],
                1 => ['data' => '06/10/2021', 'aviso' => 'Ano de pandemia', 'exibir' => false],
                2 => ['data' => '04/09/2022', 'aviso' => 'Passado é passado', 'exibir' => true]]];

    return view('avisos', $avisos);
});

Route::resource('/clientes', App\Http\Controllers\ClienteController::class);
Route::resource('/vendedores', App\Http\Controllers\vendedoresController::class);
Route::resource('/produtos', App\Http\Controllers\produtosController::class);
