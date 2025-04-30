<?php

use App\Http\Controllers\DadosController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dados.index'));

Route::get('/desafio-avelar', [DadosController::class, 'index'])->name('dados.index');
