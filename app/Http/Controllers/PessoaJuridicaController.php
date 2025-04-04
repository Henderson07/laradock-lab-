<?php

namespace App\Http\Controllers;

use App\Models\PessoaJuridica;
use App\Services\ValidacaoCNPJ;
use Illuminate\Http\Request;
use App\Http\Controllers\PessoaController;

class PessoaJuridicaController extends PessoaController
{
    public function store(Request $request)
    {
        // Validação para Pessoa Jurídica
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14',
        ]);

        // Validação de CNPJ via Service
        $validacao = new ValidacaoCNPJ();
        if (!$validacao->validar($data['cnpj'])) {
            return response()->json(['erro' => 'CNPJ inválido'], 400);
        }

        // Criar registro de Pessoa Jurídica
        $pessoaJuridica = PessoaJuridica::create($data);

        return response()->json($pessoaJuridica, 201);
    }
}
