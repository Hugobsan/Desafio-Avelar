<?php

namespace App\Http\Controllers\Api;

use App\Facades\ViaCep;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ViaCepController extends Controller
{
    public function busca($cep)
    {
        $response = ViaCep::buscarEndereco($cep);

        if ($response === NULL) {
            return response()->json(
                ['error' => 'Endereço não encontrado.'],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($response, Response::HTTP_OK);
    }
}
