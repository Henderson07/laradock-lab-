<?php

namespace App\Http\Controllers;

use App\Models\PessoaFisica;
use App\Services\ValidacaoCPF;
use Illuminate\Http\Request;
use App\Http\Controllers\PessoaController;

class PessoaFisicaController extends PessoaController
{
    public function store(Request $request)
    {
        // Valida apenas os campos específicos de Pessoa Física
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11',
        ]);

        // Validação do CPF via Service
        $validacao = new ValidacaoCPF();
        if (!$validacao->validar($data['cpf'])) {
            return response()->json(['erro' => 'CPF inválido'], 400);
        }

        // Criação do registro
        $pessoaFisica = PessoaFisica::create($data);

        return response()->json($pessoaFisica, 201);
    }
}
