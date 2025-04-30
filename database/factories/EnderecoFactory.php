<?php

namespace Database\Factories;

use App\Models\Dados;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Facades\ViaCep;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cep = $this->faker->randomElement([
            '01001000',
            '01310200',
            '20040002',
            '30130010',
            '40010000',
            '69005070',
            '88010400',
            '60110000',
            '64000020',
            '70040010'
        ]);

        // Busca cidade e estado reais pelo CEP usando a Facade
        $endereco = ViaCep::buscarEndereco($cep);

        return [
            'dados_id' => Dados::factory(),
            'cep' => $cep,
            'cidade' => $endereco['localidade'] ?? $this->faker->city,
            'estado' => $endereco['uf'] ?? $this->faker->randomElement(['SP', 'RJ', 'MG', 'RS', 'PR', 'SC', 'BA', 'ES', 'GO']),
            'bairro' => $this->faker->words(2, true),
            'rua' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'complemento' => $this->faker->optional(0.5)->secondaryAddress,
        ];
    }
}
