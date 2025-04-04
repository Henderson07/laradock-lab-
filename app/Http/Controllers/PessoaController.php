<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

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

    Pessoa::create($data);

    return redirect()->route('pessoas.index')->with('success', 'Pessoa cadastrada com sucesso!');
}


    public function index()
    {
        $pessoas = Pessoa::all();
        return view('pessoas.index', compact('pessoas'));
    }


    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return response()->json($pessoa);
    }
}
