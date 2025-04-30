<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDadosRequest extends FormRequest
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
        $this->merge([
            'cep' => preg_replace('/\D/', '', $this->cep),
            'sexo' => strtolower($this->sexo),
            'salario' => str_replace(',', '.', str_replace('.', '', $this->salario)),
            'ensino_medio' => $this->ensino_medio ? 1 : 0,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:150',
            'idade' => 'required|integer|min:0|max:120',
            'cep' => 'required|string|size:8',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:150',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'ensino_medio' => 'boolean',
            'sexo' => 'required|in:masculino,feminino,outro',
            'salario' => 'required|numeric|min:0|max:99999999999.99',
            'anexos' => 'required|array',
            'anexos.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array {
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
