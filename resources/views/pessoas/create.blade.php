@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastrar Pessoa</h1>
        <form action="{{ route('pessoas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tipo:</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="fisica">Pessoa Física</option>
                    <option value="juridica">Pessoa Jurídica</option>
                </select>
            </div>

            <div class="mb-3" id="cpf-field" style="display: none;">
                <label>CPF:</label>
                <input type="text" name="cpf" class="form-control">
            </div>

            <div class="mb-3" id="cnpj-field" style="display: none;">
                <label>CNPJ:</label>
                <input type="text" name="cnpj" class="form-control">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>

    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            document.getElementById('cpf-field').style.display = this.value === 'fisica' ? 'block' : 'none';
            document.getElementById('cnpj-field').style.display = this.value === 'juridica' ? 'block' : 'none';
        });
    </script>
@endsection
