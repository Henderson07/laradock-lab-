<?php

// app/Services/CadastroPessoaService.php
namespace App\Services;

use App\Models\Pessoa;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;

class PessoaService
{
    public function cadastrar(array $data)
    {
        // Verificar se o CPF já existe
        if ($data['tipo'] === 'F' && PessoaFisica::where('cpf', $data['cpf'])->exists()) {
            return redirect()->back()->with('error', 'CPF já cadastrado');
        }

        // Criar pessoa
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

        return $pessoa;
    }
}

