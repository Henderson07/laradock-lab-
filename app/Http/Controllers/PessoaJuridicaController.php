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
       // Nao irei precisar agora pois organizei as regras no model
    }
}
