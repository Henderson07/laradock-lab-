@extends('users.layout')

@section('content')
    <div class="container mt-5">
        <h2>Adicionar Usuário</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>CPF/CNPJ:</label>
                <input type="text" name="cpf_cnpj" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
