<?php

namespace App\Contracts;

interface ViaCepContract
{
    /**
     * Busca o endereço a partir do CEP informado.
     * @param string $cep
     * @return array|null
     */
    public function buscarEndereco(string $cep): array|null;
}
