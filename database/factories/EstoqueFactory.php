<?php

namespace Database\Factories;

use App\Models\Estoque;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstoqueFactory extends Factory
{
    protected $model = Estoque::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'produto_id' => Produto::factory(), 
            'data' => $this->faker->date(),
            'quantidade' => $this->faker->numberBetween(1, 100),
            'tipo' => $this->faker->randomElement(['entrada', 'saida']),
            'cancelado' => false,
        ];
    }
}
