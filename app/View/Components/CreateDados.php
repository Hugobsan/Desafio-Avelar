<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateDados extends Component
{
    public $dados;
    public $endereco;
    public $isEdit;

    /**
     * Create a new component instance.
     */
    public function __construct($dados = null, $endereco = null, $isEdit = false)
    {
        $this->dados = $dados;
        $this->endereco = $endereco;
        $this->isEdit = $isEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-dados');
    }
}
