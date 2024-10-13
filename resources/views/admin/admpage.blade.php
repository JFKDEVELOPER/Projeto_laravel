@extends('layouts.master')

@section('title', 'Pagina administracao')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <h1>Painel administrativo</h1>
    
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('controle_estoque') }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Controle de estoque</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('alterar_pacotes') }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Alteração de pacotes</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
