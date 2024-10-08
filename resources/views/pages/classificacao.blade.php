@extends('layouts.master')

@push('styles')
    <link href="{{ asset('css/classificacao.css') }}" rel="stylesheet">
@endpush

@section('title', 'Classificação')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <h1>Página de registro</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    {{-- Exibindo os erros de validação --}}
    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classificacao.store') }}" method="POST">
        @csrf
        <div class="comprimento-container">
            <div>
                <label for="comprimento">Comprimento:</label>
                <select name="comprimento" id="comprimento" class="comprimento" required>
                    <option value="" disabled selected>Selecione o Comprimento</option>
                    <option value="1850">1.850</option>
                    <option value="1250">1.250</option>
                    <option value="950">950</option>
                    <option value="650">650</option>
                    <option value="470">470</option>
                </select>
            </div>

            <div>
                <label for="largura">Largura:</label>
                <select name="largura" id="largura" class="comprimento" required>
                    <option value="" disabled selected>Selecione a Largura</option>
                    {{-- Opções de largura serão inseridas via JavaScript --}}
                </select>
            </div>

            <div>
                <label for="espessura">Espessura:</label>
                <select name="espessura" id="espessura" class="comprimento" required>
                    <option value="" disabled selected>Selecione a Espessura</option>
                    {{-- Opções de espessura serão inseridas via JavaScript --}}
                </select>
            </div>

            <div>
                <label for="quantidade">Quantidade:</label>
                <input type="text" name="quantidade" id="quantidade" value="{{ old('quantidade') }}" required placeholder="" class="comprimento">
            </div>
        </div>

        <div>
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>Selecione o Tipo</option>
                <option value="Capa clara">Capa clara</option>
                <option value="Capa escura">Capa escura</option>
                <option value="Parte de trás com furos">Parte de trás com furos</option>
                <option value="Parte de trás sem furos">Parte de trás sem furos</option>
            </select>
        </div>

        <button type="submit">Salvar Pacote</button>
    </form>

    <script>
        // Opções de Largura e Espessura
        const options = {
            '1850': { larguras: [144, 100], espessuras: [3.7, 2.5] },
            '1250': { larguras: [144, 100], espessuras: [3.7, 2.5] },
            '950': { larguras: [144, 100], espessuras: [3.7, 2.5] },
            '650': { larguras: [144, 100], espessuras: [3.7, 2.5] },
            '470': { larguras: [144, 100], espessuras: [3.7, 2.5] }
        };

        const comprimentoSelect = document.getElementById('comprimento');
        const larguraSelect = document.getElementById('largura');
        const espessuraSelect = document.getElementById('espessura');

        // Função para atualizar as opções de largura e espessura com base no comprimento selecionado
        comprimentoSelect.addEventListener('change', function() {
            const selectedComprimento = this.value;

            // Limpar as opções atuais de largura e espessura
            larguraSelect.innerHTML = '<option value="" disabled selected>Selecione a Largura</option>';
            espessuraSelect.innerHTML = '<option value="" disabled selected>Selecione a Espessura</option>';

            // Adicionar as novas opções de largura
            if (options[selectedComprimento]) {
                options[selectedComprimento].larguras.forEach(function(largura) {
                    const option = document.createElement('option');
                    option.value = largura;
                    option.textContent = largura;
                    larguraSelect.appendChild(option);
                });
            }
        });

        // Função para atualizar as opções de espessura com base na largura selecionada
        larguraSelect.addEventListener('change', function() {
            const selectedComprimento = comprimentoSelect.value;

            // Limpar as opções atuais de espessura
            espessuraSelect.innerHTML = '<option value="" disabled selected>Selecione a Espessura</option>';

            // Adicionar as novas opções de espessura
            if (options[selectedComprimento]) {
                options[selectedComprimento].espessuras.forEach(function(espessura) {
                    const option = document.createElement('option');
                    option.value = espessura;
                    option.textContent = espessura;
                    espessuraSelect.appendChild(option);
                });
            }
        });
    </script>
@endsection
