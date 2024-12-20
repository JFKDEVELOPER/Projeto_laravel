@extends('layouts.master')

@section('title', 'Colagem')

@section('content')
    <h1>Página de Colagem</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário para solicitar o código do pacote -->
    @if(!isset($pacote))
        <form action="{{ route('colagem.buscar') }}" method="POST">
            @csrf
            <div>
                <label for="codigo">Código do Pacote:</label>
                <input type="text" name="codigo" id="codigo" required>
            </div>
            <button type="submit">Buscar Pacote</button>
        </form>
    @else
        <!-- Exibição dos dados do pacote encontrado -->
        <h2>Dados do Pacote</h2>
        <p><strong>Código:</strong> {{ $pacote->codigo }}</p>
        <p><strong>Comprimento:</strong> {{ $pacote->comprimento }}</p>
        <p><strong>Largura:</strong> {{ $pacote->largura }}</p>
        <p><strong>Espessura:</strong> {{ $pacote->espessura }}</p>
        <p><strong>Tipo:</strong> {{ $pacote->tipo }}</p>
        <p><strong>Quantidade:</strong> <span id="quantidade-atual">{{ $pacote->quantidade }}</span></p>
        <p><strong>Status:</strong> {{ $pacote->status }}</p>

        <div class="button-container">
            <!-- Formulário para atualizar a quantidade do pacote -->
            <form action="{{ route('colagem.atualizar', $pacote->codigo) }}" method="POST"> <!-- Ajuste aqui -->
                @csrf
                <div>
                    <label for="quantidade">Alterar Quantidade:</label>
                    <input type="number" name="quantidade" id="quantidade" required min="0" value="{{ $pacote->quantidade }}"> <!-- Adicionado value -->
                    <input type="hidden" name="codigo" value="{{ $pacote->codigo }}"> <!-- Campo oculto para enviar o código -->
                </div>
                <button type="submit" style="margin-bottom: 10px;">Atualizar Pacote</button>
            </form>

            <!-- Botão para colar o pacote -->
            <form action="{{ route('colagem.colar', $pacote->codigo) }}" method="POST">
                @csrf
                <button type="submit" class="btn-danger">Pacote Colado</button>
            </form>
        </div>
    @endif
@endsection
