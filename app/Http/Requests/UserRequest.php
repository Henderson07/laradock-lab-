<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
            'cpf_cnpj' => [
                'required',
                'string',
                'unique:users,cpf_cnpj',
                function ($attribute, $value, $fail) {
                    if (!$this->validarCPF($value) && !$this->validarCNPJ($value)) {
                        $fail('O CPF/CNPJ informado é inválido.');
                    }
                }
            ]
        ];
    }

    private function validarCPF($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex: "111.111.111-11"), o que torna inválido
        if (preg_match('/^(\d)\1+$/', $cpf)) {
            return false;
        }

        // Cálculo do primeiro dígito verificador
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    private function validarCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        // Cálculo do dígito verificador
        $multiplicadores = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;

        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $multiplicadores[$i];
        }

        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        $multiplicadores = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;

        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $multiplicadores[$i];
        }

        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        return ($cnpj[12] == $digito1 && $cnpj[13] == $digito2);
    }
}
