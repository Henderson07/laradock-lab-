<?php

namespace App\Services;

class ValidacaoCPF
{
    public function validar(string $cpf): bool
    {
        // Remove caracteres especiais
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos e não é uma sequência de números repetidos
        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Cálculo dos dígitos verificadores
        return $this->calcularDigitosVerificadores($cpf);
    }

    private function calcularDigitosVerificadores(string $cpf): bool
    {
        // Cálculo do primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        // Cálculo do segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        // Verifica se os dígitos calculados correspondem aos fornecidos
        return $cpf[9] == $digito1 && $cpf[10] == $digito2;
    }
}

