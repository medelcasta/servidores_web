<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\MarcaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('/marcas', MarcaController::class);

Route::get('/coches', [CocheController::class, 'index']);

Route::get('/modelos', [ModeloController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/adios', function () {
    return view('adios');
});

Route::get('/aurora', function () {
    return view('aurora');
});