<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Actions\EstoqueAction;
use App\Http\Requests\EstoqueRequest;

class EstoqueController extends Controller
{
    protected $estoqueAction;

    /**
     * Construtor para injetar a classe EstoqueAction
     */
    public function __construct(EstoqueAction $estoqueAction)
    {
        $this->estoqueAction = $estoqueAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listar todos os registros de estoque com paginação
        $estoques = Estoque::paginate(10);
        return response()->json($estoques);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EstoqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstoqueRequest $request)
    {
        // Criar novo registro de estoque com os dados validados
        $estoque = $this->estoqueAction->create($request->validated());

        return response()->json(['message' => 'Estoque criado com sucesso', 'estoque' => $estoque], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EstoqueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstoqueRequest $request, $id)
    {
        // Tenta encontrar o estoque pelo ID
        $estoque = Estoque::find($id);

        if (!$estoque) {
            return response()->json(['message' => 'Registro de estoque não encontrado'], 404);
        }

        // Atualizar o estoque com os dados validados
        $estoque = $this->estoqueAction->update($estoque, $request->validated());

        return response()->json(['message' => 'Estoque atualizado com sucesso', 'estoque' => $estoque], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tenta encontrar o estoque pelo ID
        $estoque = Estoque::find($id);

        if (!$estoque) {
            return response()->json(['message' => 'Registro de estoque não encontrado'], 404);
        }

        // Deletar o estoque
        $this->estoqueAction->delete($estoque);

        return response()->json(['message' => 'Registro de estoque deletado com sucesso'], 200);
    }
}
