@extends('users.layout')

@section('content')
    <div class="container mt-5">
        <h2>Lista de Usuários</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Adicionar Usuário</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->cpf_cnpj }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
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
