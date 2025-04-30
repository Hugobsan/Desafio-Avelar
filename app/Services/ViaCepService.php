<?php

namespace App\Services;

use App\Contracts\ViaCepContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ViaCepService implements ViaCepContract
{
    protected const BASE_URL = 'https://viacep.com.br/ws/';

    public function buscarEndereco(string $cep): array|null
    {
        // Limpa a máscara do CEP se vier com máscara
        $cep = preg_replace('/[^0-9]/', '', $cep);

        // Monta uma key para o cache
        $cacheKey = "viacep:cep:$cep";

        // Acho que 7 dias é suficiente pra desafogar a API sem sobrecarregar o cache
        $ttl = now()->addDays(7);

        // Verifica se o CEP já está no cache
        return Cache::remember($cacheKey, $ttl, function () use ($cep) {
            // Faz a requisição para a API do ViaCep caso não tenha no cache
            $response = Http::timeout(10)
                ->retry(3, 200)
                ->get(self::BASE_URL . "{$cep}/json/");

            // Verifica se a requisição foi bem sucedida e se não houve erro
            if ($response->successful() && !$response->json('erro')) {
                return collect($response->json())->only([
                    'cep',
                    'logradouro',
                    'complemento',
                    'bairro',
                    'localidade',
                    'uf'
                ])->toArray();
            }

            Log::error('Erro ao buscar endereço no ViaCep', [
                'cep' => $cep,
                'response' => $response->json()
            ]);

            return null;
        });
    }
}
