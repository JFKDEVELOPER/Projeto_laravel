@extends('layouts.master')

@section('title', 'Pagina administracao')

@section('content')
    <h1>Admin Dashboard</h1>
    <p>Bem-vindo ao painel administrativo!</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Controle de estoque</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alteração de pacotes</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
