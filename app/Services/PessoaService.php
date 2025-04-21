<?php

namespace App\Services;

use App\Models\Pessoa;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;

class PessoaService
{
    public function cadastrar(array $data)
    {
        // Verifica duplicidade
        if ($data['tipo'] === 'F') {
            if (PessoaFisica::where('cpf', $data['cpf'])->exists()) {
                return ['success' => false, 'message' => 'CPF já cadastrado'];
            }
        }

        if ($data['tipo'] === 'J') {
            if (PessoaJuridica::where('cnpj', $data['cnpj'])->exists()) {
                return ['success' => false, 'message' => 'CNPJ já cadastrado'];
            }
        }

        // Cria pessoa e associa tipo
        $pessoa = Pessoa::create(['nome' => $data['nome']]);

        if ($data['tipo'] === 'F') {
            PessoaFisica::create([
                'pessoa_id' => $pessoa->id,
                'cpf' => $data['cpf'],
            ]);
        } elseif ($data['tipo'] === 'J') {
            PessoaJuridica::create([
                'pessoa_id' => $pessoa->id,
                'cnpj' => $data['cnpj'],
            ]);
        }

        return ['success' => true, 'pessoa' => $pessoa];
    }
}

