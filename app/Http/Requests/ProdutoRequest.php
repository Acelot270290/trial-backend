<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Aqui você pode definir se o usuário está autorizado a fazer essa requisição
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $produtoId = $this->route('produto') ? $this->route('produto')->id : null;

        return [
            'codigo' => [
                'required',
                'string',
                Rule::unique('produtos', 'codigo')->ignore($produtoId),
            ],
            'descricao' => 'required|string|max:255',
            'codigo_barras' => [
                'required',
                'string',
                Rule::unique('produtos', 'codigo_barras')->ignore($produtoId),
            ],
            'ativo' => 'required|boolean',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'codigo.required' => 'O campo código é obrigatório.',
            'codigo.unique' => 'Esse código já está em uso.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'codigo_barras.required' => 'O campo código de barras é obrigatório.',
            'codigo_barras.unique' => 'Esse código de barras já está em uso.',
            'ativo.required' => 'O campo ativo é obrigatório.',
        ];
    }
}
