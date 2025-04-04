<?php

namespace App\Services;

class PessoaService
{
    public function formatarNome(string $nome): string
    {
        return ucfirst(strtolower(trim($nome))); // Capitaliza primeira letra e remove espaços extras
    }
}
