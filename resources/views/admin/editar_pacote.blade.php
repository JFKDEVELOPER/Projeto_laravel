@extends('layouts.master')

@section('title', 'Editar Pacote')

@section('content')
<link rel="stylesheet" href="{{ asset('css/editar_pacote.css') }}">
<h1>Editar Pacote</h1>
<p>Código do Pacote Editado: {{ $pacote->codigo }}</p> <!-- Adicionado o código do pacote aqui -->

<form method="POST" action="{{ route('atualizar_pacote', $pacote->codigo) }}">
    @csrf
    @method('PUT') <!-- Indica que o método da requisição é PUT para a atualização -->
    
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" class="form-control" id="tipo" required>
            <option value="capa clara" {{ $pacote->tipo === 'capa clara' ? 'selected' : '' }}>Capa Clara</option>
            <option value="capa escura" {{ $pacote->tipo === 'capa escura' ? 'selected' : '' }}>Capa Escura</option>
            <option value="parte de tras sem furos" {{ $pacote->tipo === 'parte de tras sem furos' ? 'selected' : '' }}>Parte de Trás Sem Furos</option>
            <option value="parte de tras com furos" {{ $pacote->tipo === 'parte de tras com furos' ? 'selected' : '' }}>Parte de Trás Com Furos</option>
        </select>
    </div>

    <div class="form-group">
        <label for="comprimento">Comprimento</label>
        <select name="comprimento" class="form-control" id="comprimento" required>
            <option value="1850" {{ $pacote->comprimento == 1850 ? 'selected' : '' }}>1.850</option>
            <option value="1250" {{ $pacote->comprimento == 1250 ? 'selected' : '' }}>1.250</option>
            <option value="950" {{ $pacote->comprimento == 950 ? 'selected' : '' }}>950</option>
            <option value="650" {{ $pacote->comprimento == 650 ? 'selected' : '' }}>650</option>
            <option value="470" {{ $pacote->comprimento == 470 ? 'selected' : '' }}>470</option>
        </select>
    </div>

    <div class="form-group">
        <label for="largura">Largura</label>
        <select name="largura" class="form-control" id="largura" required>
            <option value="144" {{ $pacote->largura == 144 ? 'selected' : '' }}>144</option>
            <option value="100" {{ $pacote->largura == 100 ? 'selected' : '' }}>100</option>
        </select>
    </div>

    <div class="form-group">
        <label for="espessura">Espessura</label>
        <select name="espessura" class="form-control" id="espessura" required>
            <option value="3.7" {{ $pacote->espessura == 3.7 ? 'selected' : '' }}>3.7</option>
            <option value="2.5" {{ $pacote->espessura == 2.5 ? 'selected' : '' }}>2.5</option>
        </select>
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input type="number" name="quantidade" class="form-control" id="quantidade" value="{{ old('quantidade', $pacote->quantidade) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection
