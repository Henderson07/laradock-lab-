<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;

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
            'cpf_cnpj' => 'required|string|min:11|max:14', // O campo está correto?
            'tipo' => 'required|in:F,J'
        ]);

        Pessoa::create($data);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function index()
    {
        $pessoas = PessoaFisica::all()->concat(PessoaJuridica::all()); // Junta as duas listas corretamente

        return view('pessoas.index', compact('pessoas'));
    }




    public function edit($id)
    {
        $pessoa = PessoaFisica::find($id) ?? PessoaJuridica::find($id);
        return view('pessoas.edit', compact('pessoa'));
    }


    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return response()->json($pessoa);
    }

    public function destroy($id)
    {
        $pessoa = PessoaFisica::find($id) ?? PessoaJuridica::find($id);

        if ($pessoa) {
            $pessoa->delete();
            return redirect()->route('pessoas.index')->with('success', 'Pessoa deletada com sucesso!');
        }

        return redirect()->route('pessoas.index')->withErrors(['error' => 'Pessoa não encontrada.']);
    }

}
