@extends('layouts.master')

@section('title', 'Página de Administração')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<h1>Painel Administrativo</h1>

<div class="row">
    <div class="col-md-4">
        <a href="{{ route('controle_estoque') }}" class="card-link">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Controle de Estoque</h5>
                </div>
            </div>  
        </a>
    </div>
</div>
@endsection
