<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desafio Avelar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2>Desafio Avelar</h2>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-2">
            <form class="d-flex flex-grow-1 me-2" method="get" action="{{ route('dados.index') }}">
                <input type="text" name="q" class="form-control me-2"
                    placeholder="Pesquisar por nome, cidade ou bairro" value="{{ request('q') }}">
                <button class="btn btn-outline-primary" type="submit" data-bs-toggle="tooltip" title="Pesquisar">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button class="btn btn-success" type="button" data-bs-toggle="tooltip" title="Adicionar nova pessoa"
                disabled>
                <i class="fas fa-user-plus"></i> Nova Pessoa
            </button>
        </div>

        @if ($dados->count())
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($dados as $dado)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <div
                                class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                <div>
                                    <i class="fas fa-user me-2"></i>
                                    <strong>{{ $dado->nome ?? '-' }}</strong>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button"
                                        id="dropdownMenu{{ $dado->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="dropdownMenu{{ $dado->id }}">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="tooltip"
                                                title="Editar">
                                                <i class="fas fa-edit me-2"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('dados.destroy', $dado) }}"
                                                onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger" type="submit"
                                                    data-bs-toggle="tooltip" title="Excluir">
                                                    <i class="fas fa-trash-alt me-2"></i> Excluir
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-1">
                                    <span class="fw-semibold"><i class="fas fa-id-card me-1"></i>Idade:</span>
                                    {{ $dado->idade ?? '-' }}
                                </p>
                                <p class="mb-1">
                                    <span class="fw-semibold"><i class="fas fa-graduation-cap me-1"></i>Ensino
                                        Médio:</span>
                                    {{ $dado->ensino_medio ? 'Sim' : 'Não' }}
                                </p>
                                <p class="mb-1">
                                    <span class="fw-semibold"><i class="fas fa-venus-mars me-1"></i>Sexo:</span>
                                    {{ ucfirst($dado->sexo) ?? '-' }}
                                </p>
                                <p class="mb-1">
                                    <span class="fw-semibold"><i class="fas fa-money-bill-wave me-1"></i>Salário:</span>
                                    R$ {{ number_format($dado->salario, 2, ',', '.') }}
                                </p>
                                <hr>
                                <p class="mb-1">
                                    <span class="fw-semibold"><i class="fas fa-map-marker-alt me-1"></i>Endereço:</span>
                                    @if ($dado->endereco)
                                        {{ $dado->endereco->rua ?? '-' }},
                                        {{ $dado->endereco->numero ?? '-' }}{{ $dado->endereco->complemento ? ' - ' . $dado->endereco->complemento : '' }}<br>
                                        {{ $dado->endereco->bairro ?? '-' }} -
                                        {{ $dado->endereco->cidade ?? '-' }}/{{ $dado->endereco->estado ?? '-' }}<br>
                                        CEP:
                                        {{ $dado->endereco->cep ? preg_replace('/(\d{5})(\d{3})/', '$1-$2', $dado->endereco->cep) : '-' }}
                                    @else
                                        <span class="text-muted">Não informado</span>
                                    @endif
                                </p>
                                <hr>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-semibold"><i class="fas fa-paperclip me-1"></i>Anexos</span>
                                        <form method="POST" action="{{ route('dados.storeAnexo', $dado->id) }}"
                                            enctype="multipart/form-data" class="d-inline-block">
                                            @csrf
                                            <label class="btn btn-sm btn-outline-primary mb-0" data-bs-toggle="tooltip"
                                                title="Adicionar anexo">
                                                <i class="fas fa-plus"></i>
                                                <input type="file" name="anexo" accept=".pdf,.jpg,.jpeg,.png"
                                                    class="d-none" onchange="this.form.submit()">
                                            </label>
                                        </form>
                                    </div>
                                    @if ($dado->anexos && $dado->anexos->count())
                                        <ul class="list-group list-group-flush">
                                            @foreach ($dado->anexos as $anexo)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <a href="{{ asset('storage/' . $anexo->path) }}" target="_blank"
                                                        class="text-decoration-none" data-bs-toggle="tooltip"
                                                        title="Abrir anexo">
                                                        <i
                                                            class="fas fa-file-{{ $anexo->extension === 'pdf' ? 'pdf' : 'image' }} text-secondary me-2"></i>
                                                        {{ $anexo->name }}
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('dados.destroyAnexo', $anexo->id) }}"
                                                        class="ms-2"
                                                        onsubmit="return confirm('Excluir este anexo?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-link text-danger p-0"
                                                            type="submit" data-bs-toggle="tooltip"
                                                            title="Excluir anexo">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">Nenhum anexo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $dados->links() }}
            </div>
        @else
            <div class="alert alert-info text-center mt-5">
                <i class="fas fa-info-circle me-2"></i>
                Nenhum registro encontrado.
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>
