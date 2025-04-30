<?php

use App\Http\Controllers\Api\ViaCepController;
use Illuminate\Support\Facades\Route;

Route::get('/busca-cep/{cep}', [ViaCepController::class, 'busca']);
