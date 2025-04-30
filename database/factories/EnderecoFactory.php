<?php

namespace Database\Factories;

use App\Models\Dados;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'dados_id' => Dados::factory(),
            'cep' => $this->faker->numerify('########'),
            'cidade' => $this->faker->city,
            'estado' => $this->faker->randomElement(['SP', 'RJ', 'MG', 'RS', 'PR', 'SC', 'BA', 'ES', 'GO']),
            'bairro' => $this->faker->words(2, true),
            'rua' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'complemento' => $this->faker->optional(0.5)->secondaryAddress,
        ];
    }
}
