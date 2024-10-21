<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('P###'), 
            'descricao' => $this->faker->word(),
            'codigo_barras' => $this->faker->unique()->ean13(), 
            'ativo' => true,
        ];
    }
}
