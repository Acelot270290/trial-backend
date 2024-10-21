<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {  // Corrigido o nome para 'estoques'
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Garantindo a exclusão em cascata
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade'); // Garantindo a exclusão em cascata
            $table->date('data');
            $table->integer('quantidade');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->boolean('cancelado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoques');  // Mantendo o nome da tabela como 'estoques'
    }
};
