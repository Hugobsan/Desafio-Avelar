<?php

namespace App\Observers;

use App\Facades\FileManager;
use App\Models\Dados;
use Illuminate\Support\Facades\Log;

class DadosObserver
{
    public function deleting(Dados $dados)
    {
        // Isso aqui bem que podia ser um job, mas não é o foco do projeto
        foreach ($dados->anexos as $anexo) {
            if ($anexo) {
                FileManager::delete($anexo);
            }
        }
    }
}
