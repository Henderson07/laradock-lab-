@extends('layouts.app')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container">
    <h1>Lista de Pessoas</h1>
    <a href="{{ route('pessoas.create') }}" class="btn btn-primary">Cadastrar Pessoa</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>CPF/CNPJ</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pessoas as $pessoa)
                <tr>
                    <td>{{ $pessoa->nome }}</td>
                    <td>
                        @if ($pessoa->cpf)
                            <span class="badge bg-info">Pessoa Física</span>
                        @else
                            <span class="badge bg-warning">Pessoa Jurídica</span>
                        @endif
                    </td>
                    <td>{{ $pessoa->cpf ?? $pessoa->cnpj }}</td>
                    <td>
                        <a href="{{ route('pessoas.edit', $pessoa->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('pessoas.destroy', $pessoa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
