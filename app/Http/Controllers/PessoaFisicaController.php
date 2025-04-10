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
       // Nao irei precisar agora pois organizei as regras no model
    }
}
