<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dados>
 */
class DadosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'idade' => $this->faker->numberBetween(18, 80),
            'ensino_medio' => $this->faker->boolean,
            'sexo' => $this->faker->randomElement(['masculino', 'feminino', 'outro']),
            'salario' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
