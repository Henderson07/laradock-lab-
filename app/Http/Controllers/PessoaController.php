<?php

// app/Http/Controllers/PessoaController.php
namespace App\Http\Controllers;

use App\Services\ValidacaoCPF;
use App\Services\ValidacaoCNPJ;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Services\PessoaService;

class PessoaController extends Controller
{
    protected $cadastroService;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    public function store(Request $request)
    {
        $this->pessoaService->cadastrar($request->all());

        $validacaoCPF = new ValidacaoCPF();
        $validacaoCNPJ = new ValidacaoCNPJ();

        if ($request->tipo === 'F' && !$validacaoCPF->validar($request->cpf)) {
            return redirect()->back()->with('error', 'CPF inválido');
        }

        if ($request->tipo === 'J' && !$validacaoCNPJ->validar($request->cnpj)) {
            return redirect()->back()->with('error', 'CNPJ inválido');
        }

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function index()
    {
        $pessoas = Pessoa::with(['pessoaFisica', 'pessoaJuridica'])->get();
        return view('pessoas.index', compact('pessoas'));
    }

    public function create()
    {
        return view('pessoas.create');
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::with(['pessoaFisica', 'pessoaJuridica'])->findOrFail($id);

        $pessoa->pessoaFisica?->delete();
        $pessoa->pessoaJuridica?->delete();
        $pessoa->delete();

        return redirect()->route('pessoas.index')->with('success', 'Pessoa deletada com sucesso!');
    }
}

