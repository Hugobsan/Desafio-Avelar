<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ViaCep extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Contracts\ViaCepContract::class;
    }
}
