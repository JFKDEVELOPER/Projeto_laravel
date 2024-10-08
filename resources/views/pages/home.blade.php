@extends('layouts.master')

@section('title', 'Home')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h1>Bem-vindo à Página Inicial</h1>
    <div class="row">
        @foreach($featuredPosts as $post)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post['title'] }}</h5>
                        <p class="card-text">{{ $post['content'] }}</p>
                        
                        <a href="{{ route(strtolower($post['title'])) }}" class="btn btn-primary">Ir para {{ $post['title'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
