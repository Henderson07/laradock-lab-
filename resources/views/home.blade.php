@extends('layouts.app')

@section('title', 'Página Inicial')
@section('page-title', 'Bem-vindo ao Sistema')

@section('content')
<div class="container">
    <p>Escolha uma das opções abaixo:</p>
    <a href="{{ route('pessoas.index') }}" class="btn btn-primary">Gerenciar Pessoas</a>
    <a href="{{ route('products.index') }}" class="btn btn-success">Gerenciar Produtos</a>
</div>
@endsection
