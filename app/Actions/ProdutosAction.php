<?php

namespace App\Actions;

use App\Models\Produto;

class ProdutosAction
{
    /**
     * Criar um novo produto no banco de dados.
     *
     * @param array $data
     * @return Produto
     */
    public function create(array $data)
    {
        return Produto::create($data);
    }

    /**
     * Atualizar um produto no banco de dados.
     *
     * @param Produto $produto
     * @param array $data
     * @return Produto
     */
    public function update(Produto $produto, array $data)
    {
        $produto->update($data);
        return $produto;
    }

    /**
     * Deletar um produto do banco de dados.
     *
     * @param Produto $produto
     * @return void
     */
    public function delete(Produto $produto)
    {
        $produto->delete();
    }
}
