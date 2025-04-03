@extends('users.layout')

@section('content')
    <div class="container mt-5">
        <h2>Editar Usuário</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label>CPF/CNPJ:</label>
                <input type="text" name="cpf_cnpj" class="form-control" value="{{ $user->cpf_cnpj }}" required>
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
@endsection
