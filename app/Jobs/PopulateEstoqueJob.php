<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Estoque;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\Log; // Importando Log

class PopulateEstoqueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Log::info('Iniciando PopulateEstoqueJob');

     
        $usuarios = User::all(); 
        $produtos = Produto::all(); 

        foreach ($usuarios as $usuario) {
            foreach ($produtos as $produto) {

               
                Log::info("Criando estoque para usuário {$usuario->id} e produto {$produto->id}");

                Estoque::create([
                    'user_id' => $usuario->id,
                    'produto_id' => $produto->id,
                    'data' => now(),
                    'quantidade' => rand(1, 100), 
                    'tipo' => rand(0, 1) ? 'entrada' : 'saida',
                    'cancelado' => false,
                ]);
            }
        }

        
        Log::info('PopulateEstoqueJob finalizado.');
    }
}
