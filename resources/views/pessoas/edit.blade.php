@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pessoa</h1>
    <form action="{{ route('pessoas.update', ['pessoa' => $pessoa->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="{{ $pessoa->nome }}" required>
        </div>

        @if ($pessoa->pessoaFisica)
            <div class="mb-3">
                <label>CPF:</label>
                <input type="text" name="cpf" class="form-control" value="{{ $pessoa->pessoaFisica->cpf }}">
            </div>
        @elseif ($pessoa->pessoaJuridica)
            <div class="mb-3">
                <label>CNPJ:</label>
                <input type="text" name="cnpj" class="form-control" value="{{ $pessoa->pessoaJuridica->cnpj }}">
            </div>
        @endif

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
    </form>
</div>
@endsection
