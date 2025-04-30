<?php

namespace App\Contracts;

interface ViaCepContract
{
    public function buscarEndereco(string $cep): array|null;
}
