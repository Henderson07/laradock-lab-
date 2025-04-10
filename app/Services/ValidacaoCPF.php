<?php

namespace App\Services;

class ValidacaoCPF
{
    public function validar(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remove caracteres especiais

        dd($cpf); // Teste para ver se o CPF está correto antes de validar

        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false; // CPF inválido (tamanho incorreto ou sequência repetida)
        }

        return true; // Simulação de retorno válido
    }
}
