<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('editora', App\Http\Controllers\EditoraController::class);
    Route::resource('livro', App\Http\Controllers\LivroController::class);
    Route::resource('genero', App\Http\Controllers\GeneroController::class);
    Route::resource('autor', App\Http\Controllers\AutorController::class);
    Route::resource('cliente', App\Http\Controllers\ClienteController::class);
    Route::resource('locacao', App\Http\Controllers\LocacaoController::class);

    Route::get('/consulta-cep', [ClienteController::class, 'consultaCep'])->name('consulta.cep');



});

