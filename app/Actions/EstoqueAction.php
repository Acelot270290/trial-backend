<?php

namespace App\Actions;

use App\Models\Estoque;

class EstoqueAction
{
    /**
     * Criar um novo registro de estoque no banco de dados.
     *
     * @param array $data
     * @return Estoque
     */
    public function create(array $data)
    {
        return Estoque::create($data);
    }

    /**
     * Atualizar um registro de estoque no banco de dados.
     *
     * @param Estoque $estoque
     * @param array $data
     * @return Estoque
     */
    public function update(Estoque $estoque, array $data)
    {
        $estoque->update($data);
        return $estoque;
    }

    /**
     * Deletar um registro de estoque do banco de dados.
     *
     * @param Estoque $estoque
     * @return void
     */
    public function delete(Estoque $estoque)
    {
        $estoque->delete();
    }
}
