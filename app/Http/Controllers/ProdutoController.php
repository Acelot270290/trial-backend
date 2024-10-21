<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use App\Actions\ProdutosAction;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $produtosAction;

    /**
     * Construtor para injetar a classe ProdutosAction
     */
    public function __construct(ProdutosAction $produtosAction)
    {
        $this->produtosAction = $produtosAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listar todos os produtos com paginação
        $produtos = Produto::paginate(10);
        return response()->json($produtos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        // Criar um novo produto com os dados validados usando ProdutosAction
        $produto = $this->produtosAction->create($request->validated());

        return response()->json(['message' => 'Produto criado com sucesso', 'produto' => $produto], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Tenta encontrar o produto pelo ID
        $produto = Produto::find($id);
    
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
    
        return response()->json($produto, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProdutoRequest  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, Produto $produto)
    {
        // Atualizar o produto com os dados validados usando ProdutosAction
        $produto = $this->produtosAction->update($produto, $request->validated());

        return response()->json(['message' => 'Produto atualizado com sucesso', 'produto' => $produto], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Tenta encontrar o produto pelo ID
    $produto = Produto::find($id);

    if (!$produto) {
        return response()->json(['message' => 'Produto não encontrado'], 404);
    }

    $this->produtosAction->delete($produto);

    return response()->json(['message' => 'Produto deletado com sucesso'], 200);
}

}
