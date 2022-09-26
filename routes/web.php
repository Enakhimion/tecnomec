<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Route per la gestione degli articoli
Route::resource('articoli', \App\Http\Controllers\ArticoloController::class)->parameters(['articoli' => 'articolo']);

//Route per la gestione dei clienti
Route::resource('clienti', \App\Http\Controllers\ClienteController::class)->parameters(['clienti' => 'cliente']);

//Route per la gestione dei materiali
Route::resource('materiali', \App\Http\Controllers\MaterialeController::class)->parameters(['materiali' => 'materiale']);

require __DIR__.'/auth.php';
