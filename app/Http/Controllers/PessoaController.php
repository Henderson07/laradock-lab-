<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

use App\Services\ValidacaoCPF;
use App\Services\ValidacaoCNPJ;

class PessoaController extends Controller
{
    public function create()
    {
        return view('pessoas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|size:11',
            'cnpj' => 'nullable|string|size:14',
        ]);

        // Criando instâncias dos serviços de validação
        $validadorCPF = new ValidacaoCPF();
        $validadorCNPJ = new ValidacaoCNPJ();

        // Validar CPF
        if (!empty($data['cpf']) && !$validadorCPF->validar($data['cpf'])) {
            return redirect()->back()->withErrors(['cpf' => 'O CPF informado é inválido.']);
        }

        // Validar CNPJ
        if (!empty($data['cnpj']) && !$validadorCNPJ->validar($data['cnpj'])) {
            return redirect()->back()->withErrors(['cnpj' => 'O CNPJ informado é inválido.']);
        }

        // Garantir que apenas um dos campos seja preenchido
        if (!empty($data['cpf'])) {
            $data['cnpj'] = null;
        } elseif (!empty($data['cnpj'])) {
            $data['cpf'] = null;
        }

        Pessoa::create($data);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function index()
    {
        $pessoas = Pessoa::all(); // Busca todas as pessoas cadastradas
        return view('pessoas.index', compact('pessoas'));
    }

    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }

    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return response()->json($pessoa);
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa deletada com sucesso');
    }
}
