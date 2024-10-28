@extends('layouts.master')

@section('title', 'Controle de Estoque')

@section('content')
<link rel="stylesheet" href="{{ asset('css/controle_estoque.css') }}">

<h1>Controle de Estoque</h1>


<form method="GET" action="{{ route('controle_estoque') }}">
    <div class="row mb-3">
        <div class="col">
            <label for="tipo">Tipo</label>
            <select name="tipo" class="form-control" id="tipo">
                <option value="">Todos</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="comprimento">Comprimento</label>
            <select name="comprimento" class="form-control" id="comprimento">
                <option value="">Todos</option>
                @foreach ($comprimentos as $comprimento)
                    <option value="{{ $comprimento }}">{{ $comprimento }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="largura">Largura</label>
            <select name="largura" class="form-control" id="largura">
                <option value="">Todos</option>
                @foreach ($larguras as $largura)
                    <option value="{{ $largura }}">{{ $largura }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="espessura">Espessura</label>
            <select name="espessura" class="form-control" id="espessura">
                <option value="">Todos</option>
                @foreach ($espessuras as $espessura)
                    <option value="{{ $espessura }}">{{ $espessura }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="">Todos</option>
                @foreach ($status as $stat)
                    <option value="{{ $stat }}">{{ $stat }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>

<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Comprimento</th>
            <th>Largura</th>
            <th>Espessura</th>
            <th>Quantidade</th>
            <th>Status</th>
            <th>Código</th>
            <th>Ações</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($pacotes as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->tipo }}</td>
                <td>{{ $item->comprimento }}</td>
                <td>{{ $item->largura }}</td>
                <td>{{ $item->espessura }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->codigo }}</td>
                <td>
                    <a href="{{ route('alterar_pacote', $item->codigo) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('deletar_pacote', $item->codigo) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este pacote?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td> 
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
