@props([
    'dados' => null,
    'endereco' => null,
])

<x-create-dados 
    :action="route('dados.update', $dados->id)" 
    method="POST"
    :dados="$dados"
    :endereco="$endereco"
    :isEdit="true"
/>