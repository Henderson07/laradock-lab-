<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pessoa;
use App\Services\PessoaService;

use App\Services\ValidacaoCPF;
use App\Services\ValidacaoCNPJ;

class PessoaController extends Controller
{
    protected $pessoaService;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    public function store(Request $request)
    {
        $validacaoCPF = new ValidacaoCPF();
        $validacaoCNPJ = new ValidacaoCNPJ();

        if ($request->tipo === 'F' && !$validacaoCPF->validar($request->cpf)) {
            return redirect()->back()->with('error', 'CPF inválido');
        }

        if ($request->tipo === 'J' && !$validacaoCNPJ->validar($request->cnpj)) {
            return redirect()->back()->with('error', 'CNPJ inválido');
        }

        $resultado = $this->pessoaService->cadastrar($request->all());

        if (!$resultado['success']) {
            return redirect()->back()->with('error', $resultado['message']);
        }

        return redirect()->route('pessoas.index')->with('success', 'Pessoa cadastrada com sucesso!');
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

