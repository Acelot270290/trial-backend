<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;
use App\Models\User;
use App\Models\Produto;

class EstoqueSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::all();
        $produtos = Produto::all();

        if ($usuarios->isEmpty() || $produtos->isEmpty()) {
            $this->command->info('Não há usuários ou produtos suficientes para criar registros de estoque.');
            return;
        }

    
        Estoque::factory()->count(50)->create([
            'user_id' => $usuarios->random()->id,   
            'produto_id' => $produtos->random()->id 
        ]);
    }
}
