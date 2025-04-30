<?php

use App\Http\Controllers\DadosController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dados.index'));

Route::get('/desafio-avelar', [DadosController::class, 'index'])->name('dados.index');

Route::resource('dados', DadosController::class)
    ->except(['index'])
    ->parameters(['dados' => 'dados']); // Corrigindo binding porque eu criei o model no plural

Route::post('/dados/{dados}/anexos', [DadosController::class, 'storeAnexo'])
    ->name('dados.storeAnexo');
Route::delete('anexos/{file}', [DadosController::class, 'destroyAnexo'])
    ->name('dados.destroyAnexo');
