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
Route::resource('articoli', \App\Http\Controllers\ArticoloController::class)
    ->parameters(['articoli' => 'articolo']);

//Route per la gestione dei clienti
Route::resource('clienti', \App\Http\Controllers\ClienteController::class)
    ->parameters(['clienti' => 'cliente']);

//Route per la gestione dei materiali
Route::resource('materiali', \App\Http\Controllers\MaterialeController::class)
    ->parameters(['materiali' => 'materiale']);

//Route per la gestione dei macchinari
Route::resource('macchinari', \App\Http\Controllers\MacchinarioController::class)
    ->parameters(['macchinari' => 'macchinario']);

//Route per la gestione delle lavorazioni esterne
Route::resource('articoli.lav_esterne', \App\Http\Controllers\LavEsternaController::class, ['names' => 'lav_esterne'])
    ->parameters(['articoli' => 'articolo','lav_esterne' => 'lav_esterna']);

//Route per la gestione delle lavorazioni interne
Route::resource('articoli.lav_interne', \App\Http\Controllers\LavInternaController::class, ['names' => 'lav_interne'])
    ->parameters(['articoli' => 'articolo','lav_interne' => 'lav_interna']);

//Route per la gestione degli altri costi
Route::resource('articoli.altri_costi', \App\Http\Controllers\AltroCostoController::class, ['names' => 'altri_costi'])
    ->parameters(['articoli' => 'articolo','altri_costi' => 'altro_costo']);

require __DIR__.'/auth.php';
