@props([
    'action' => route('dados.store'),
    'method' => 'POST',
    'dados' => null,
    'endereco' => null,
    'isEdit' => false,
])

<form 
    action="{{ $action }}" 
    method="POST" 
    enctype="multipart/form-data" 
    id="form-create-dados"
>
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nome *</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                value="{{ old('nome', $dados->nome ?? '') }}" required maxlength="150">
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Idade *</label>
            <input type="number" name="idade" class="form-control @error('idade') is-invalid @enderror"
                value="{{ old('idade', $dados->idade ?? '') }}" required min="0" max="120">
            @error('idade') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Salário *</label>
            <input type="text" name="salario" class="form-control @error('salario') is-invalid @enderror"
                value="{{ old('salario', isset($dados->salario) ? number_format($dados->salario, 2, ',', '.') : '') }}" required pattern="^\d{1,3}(\.\d{3})*,\d{2}$|^\d+,\d{2}$">
            @error('salario') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Sexo *</label>
            <select name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                <option value="">Selecione</option>
                <option value="masculino" @selected(old('sexo', $dados->sexo ?? '')=='masculino')>Masculino</option>
                <option value="feminino" @selected(old('sexo', $dados->sexo ?? '')=='feminino')>Feminino</option>
                <option value="outro" @selected(old('sexo', $dados->sexo ?? '')=='outro')>Outro</option>
            </select>
            @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="ensino_medio" id="ensino_medio"
                    value="1" {{ old('ensino_medio', $dados->ensino_medio ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="ensino_medio">
                    Possui Ensino Médio
                </label>
            </div>
        </div>
    </div>

    <hr>
    <h6 class="mt-3">Endereço</h6>
    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label">CEP *</label>
            <input type="text" name="cep" id="cep" maxlength="9"
                class="form-control @error('cep') is-invalid @enderror"
                value="{{ old('cep', $endereco->cep ?? '') }}" required>
            @error('cep') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Cidade *</label>
            <input type="text" name="cidade" id="cidade"
                class="form-control @error('cidade') is-invalid @enderror"
                value="{{ old('cidade', $endereco->cidade ?? '') }}" required readonly>
            @error('cidade') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label">Estado *</label>
            <input type="text" name="estado" id="estado"
                class="form-control @error('estado') is-invalid @enderror"
                value="{{ old('estado', $endereco->estado ?? '') }}" required readonly>
            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Bairro *</label>
            <input type="text" name="bairro" id="bairro"
                class="form-control @error('bairro') is-invalid @enderror"
                value="{{ old('bairro', $endereco->bairro ?? '') }}" required readonly>
            @error('bairro') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Rua *</label>
            <input type="text" name="rua" id="rua"
                class="form-control @error('rua') is-invalid @enderror"
                value="{{ old('rua', $endereco->rua ?? '') }}" required readonly>
            @error('rua') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label">Número *</label>
            <input type="text" name="numero"
                class="form-control @error('numero') is-invalid @enderror"
                value="{{ old('numero', $endereco->numero ?? '') }}" required>
            @error('numero') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Complemento</label>
            <input type="text" name="complemento"
                class="form-control @error('complemento') is-invalid @enderror"
                value="{{ old('complemento', $endereco->complemento ?? '') }}">
            @error('complemento') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    @unless($isEdit)
    <hr>
    <div class="mb-3 mt-3">
        <label class="form-label">Anexos (PDF, JPG, PNG, máx. 10MB cada) *</label>
        <input type="file" name="anexos[]" class="form-control @error('anexos') is-invalid @enderror"
            accept=".pdf,.jpg,.jpeg,.png" multiple required
            onchange="for(let f of this.files){if(f.size>10485760){alert('Arquivo excede 10MB!');this.value='';}}">
        @error('anexos') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @error('anexos.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    @endunless

    <div class="mt-4 d-flex justify-content-end">
        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cepInput = document.getElementById('cep');
    const cidadeInput = document.getElementById('cidade');
    const estadoInput = document.getElementById('estado');
    const bairroInput = document.getElementById('bairro');
    const ruaInput = document.getElementById('rua');

    function setReadOnly(fields, readonly = true) {
        fields.forEach(f => f.readOnly = readonly);
    }

    setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], true);

    cepInput.addEventListener('input', async function() {
        let cep = this.value.replace(/\D/g, '');
        if (cep.length === 8) {
            setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], true);
            cidadeInput.value = estadoInput.value = bairroInput.value = ruaInput.value = '';
            try {
                const resp = await fetch(`/api/busca-cep/${cep}`);
                if (resp.ok) {
                    const data = await resp.json();
                    if (data && !data.erro) {
                        cidadeInput.value = data.localidade || '';
                        estadoInput.value = data.uf || '';
                        bairroInput.value = data.bairro || '';
                        ruaInput.value = data.logradouro || '';
                        setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], true);
                    } else {
                        setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], false);
                    }
                } else {
                    setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], false);
                }
            } catch {
                setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], false);
            }
        } else {
            cidadeInput.value = estadoInput.value = bairroInput.value = ruaInput.value = '';
            setReadOnly([cidadeInput, estadoInput, bairroInput, ruaInput], true);
        }
    });
});
</script>