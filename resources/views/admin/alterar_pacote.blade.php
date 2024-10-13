@extends('layouts.master')

@section('title', 'Alteração de Pacotes')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<h1>Alteração de Pacotes</h1>

<div class="container">
    <form action="{{ route('colagem.buscar') }}" method="POST"> <!-- Rota para buscar pacotes -->
        @csrf
        <div class="form-group">
            <label for="codigo">Código do Pacote:</label>
            <input type="text" name="codigo" id="codigo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar Pacote</button>
    </form>

    @if(session('pacote'))
        @php $pacote = session('pacote'); @endphp
        <h2>Informações do Pacote</h2>
        <div class="info-pacote">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Código:</strong> {{ $pacote->codigo }}</p>
                    <p><strong>Tipo:</strong> {{ $pacote->tipo }}</p>
                    <p><strong>Comprimento:</strong> {{ $pacote->comprimento }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Largura:</strong> {{ $pacote->largura }}</p>
                    <p><strong>Espessura:</strong> {{ $pacote->espessura }}</p>
                    <p><strong>Quantidade:</strong> {{ $pacote->quantidade }}</p>
                    <p><strong>Status:</strong> {{ $pacote->status }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <!-- Alterando a rota do botão "Editar" para a rota de edição -->
                <a href="{{ route('colagem.alterar', $pacote->codigo) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('colagem.colar', $pacote->codigo) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Colar</button>
                </form>
            </div>
        </div>
    @else
        <p>Nenhum pacote encontrado. Por favor, busque um pacote pelo código.</p>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
</div>
@endsection
