@extends('layouts.master')

@section('title', 'Página de Administração')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<h1>Painel Administrativo</h1>

<div class="row">
    <div class="col-md-4">
        <a href="{{ route('controle_estoque') }}" class="card-link"> <!-- Corrigido para a rota correta -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Controle de Estoque</h5>
                </div>
            </div>  
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('alterar_pacote') }}" class="card-link"> <!-- Certifique-se de usar o nome correto da rota -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alteração de Pacotes</h5>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
