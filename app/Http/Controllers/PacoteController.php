<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacotes;

class PacoteController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'comprimento' => 'required|numeric',
            'largura' => 'required|numeric',
            'espessura' => 'required|numeric',
            'tipo' => 'required|string',
            'quantidade' => 'required|numeric',
        ]);

        // Gerar código de 4 dígitos e garantir que não se repita
        do {
            $codigo = mt_rand(1000, 9999);
        } while (Pacotes::where('codigo', $codigo)->exists());

        // Cria um novo pacote
        $pacote = new Pacotes();
        $pacote->comprimento = $request->comprimento;
        $pacote->largura = $request->largura;
        $pacote->espessura = $request->espessura;
        $pacote->tipo = $request->tipo;
        $pacote->codigo = $codigo;
        $pacote->quantidade = $request->quantidade;
        $pacote->status = ($pacote->quantidade === 0) ? 'colado' : 'estoque';
        $pacote->save();

        return redirect()->route('classificacao')->with('success', 'Pacote criado com sucesso! O ID do pacote é: ' . $codigo);
    }

    public function buscar(Request $request)
    {
        // Validação do código do pacote
        $request->validate([
            'codigo' => 'required|string|size:4',
        ]);

        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $request->codigo)->first();

        // Verifica se o pacote foi encontrado
        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']);
        }

        // Retorna a view com os dados do pacote encontrado
        return view('pages.colagem', compact('pacote'));
    }

    public function atualizar(Request $request)
    {
        // Validação dos dados de atualização
        $request->validate([
            'codigo' => 'required|string|size:4',
            'quantidade' => 'required|numeric',
        ]);

        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $request->codigo)->first();

        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']);
        }

        // Atualiza a quantidade e o status
        $pacote->quantidade = $request->quantidade;
        $pacote->status = ($pacote->quantidade === 0) ? 'colado' : 'estoque';
        $pacote->save();

        return redirect()->route('colagem')->with('success', 'Pacote atualizado com sucesso!');
    }

    public function colar($codigo)
    {
        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->first();

        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']);
        }

        // Define a quantidade como 0 e atualiza o status
        $pacote->quantidade = 0;
        $pacote->status = 'colado';
        $pacote->save();

        return redirect()->route('colagem')->with('success', 'Pacote colado com sucesso!');
    }
}
