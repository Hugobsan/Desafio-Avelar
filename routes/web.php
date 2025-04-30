<?php

use App\Http\Controllers\DadosController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dados.index'));

Route::get('/desafio-avelar', [DadosController::class, 'index'])->name('dados.index');

Route::resource('dados', DadosController::class)
    ->except(['index']);

Route::post('/dados/{id}/anexos', [DadosController::class, 'storeAnexo'])
    ->name('dados.storeAnexo');
Route::delete('anexos/{file}', [DadosController::class, 'destroyAnexo'])
    ->name('dados.destroyAnexo');
