@extends('layouts.app')

@section('title', 'Cadastrar Pessoa')
@section('page-title', 'Nova Pessoa')

@section('content')
<div class="container">
    <form action="{{ route('pessoas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="tipo">Tipo de Pessoa:</label>
            <select name="tipo" id="tipo" class="form-control" required onchange="toggleCampos()">
                <option value="">Selecione</option>
                <option value="F">Física</option>
                <option value="J">Jurídica</option>
            </select>
        </div>

        <div class="form-group mt-2" id="campo-cpf" style="display: none;">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control">
        </div>

        <div class="form-group mt-2" id="campo-cnpj" style="display: none;">
            <label for="cnpj">CNPJ:</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </form>
</div>

<script>
    function toggleCampos() {
        const tipo = document.getElementById('tipo').value;
        document.getElementById('campo-cpf').style.display = (tipo === 'F') ? 'block' : 'none';
        document.getElementById('campo-cnpj').style.display = (tipo === 'J') ? 'block' : 'none';
    }
</script>
@endsection
