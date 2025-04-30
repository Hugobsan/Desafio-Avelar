<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDadosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $data = [];

        if ($this->has('cep')) {
            $data['cep'] = preg_replace('/\D/', '', $this->cep);
        }
        if ($this->has('sexo')) {
            $data['sexo'] = strtolower($this->sexo);
        }
        if ($this->has('salario')) {
            $data['salario'] = str_replace(',', '.', str_replace('.', '', $this->salario));
        }
        if ($this->has('ensino_medio')) {
            $data['ensino_medio'] = $this->ensino_medio ? 1 : 0;
        }

        if (!empty($data)) {
            $this->merge($data);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'nullable|string|max:150',
            'idade' => 'nullable|integer|min:0|max:120',
            'cep' => 'nullable|string|size:8',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|size:2',
            'bairro' => 'nullable|string|max:100',
            'rua' => 'nullable|string|max:150',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'ensino_medio' => 'nullable|boolean',
            'sexo' => 'nullable|in:masculino,feminino,outro',
            'salario' => 'nullable|numeric|min:0|max:99999999999.99',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'numeric' => 'O campo :attribute deve ser um número.',
            'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
            'size' => 'O campo :attribute deve ter exatamente :size caracteres.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'min' => 'O campo :attribute deve ser maior ou igual a :min.',
            'in' => 'O campo :attribute deve ser um dos seguintes valores: :values.',
            'cep.size' => 'O campo CEP deve ter exatamente 8 dígitos.',
            'cep.regex' => 'O campo CEP deve conter apenas números.',
            'estado.size' => 'O campo estado deve ter exatamente 2 caracteres.',
        ];
    }
}
