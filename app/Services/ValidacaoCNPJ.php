<?php

namespace App\Services;

class ValidacaoCNPJ
{
    public function validar(string $cnpj): bool
    {
        // Remove caracteres especiais
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se o CNPJ tem 14 dígitos e não é uma sequência de números repetidos
        if (strlen($cnpj) !== 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Cálculo dos dígitos verificadores
        return $this->calcularDigitosVerificadores($cnpj);
    }

    private function calcularDigitosVerificadores(string $cnpj): bool
    {
        // Cálculo do primeiro dígito verificador
        $pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $pesos1[$i];
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        // Cálculo do segundo dígito verificador
        $pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $pesos2[$i];
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        // Verifica se os dígitos calculados correspondem aos fornecidos
        return $cnpj[12] == $digito1 && $cnpj[13] == $digito2;
    }
}

