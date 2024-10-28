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
            'tipo' => 'required|string|in:capa clara,capa escura,parte de tras sem furos,parte de tras com furos',
            'quantidade' => 'required|numeric|min:0', // Validação para garantir que a quantidade não seja negativa
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

        return redirect()->route('classificacao')->with('success', 'Pacote criado com sucesso! O código do pacote é: ' . $codigo);
    }

    public function buscar(Request $request)
    {
        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $request->codigo)->first();

        // Verifica se o pacote foi encontrado
        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']);
        }

        // Retorna a view com os dados do pacote encontrado
        return view('pages.colagem', compact('pacote'));
    }

    public function atualizar(Request $request, $codigo)
    {
        // Validação dos dados de atualização
        $request->validate([
            'quantidade' => 'required|numeric|min:0', // Garantir que a quantidade não seja negativa
        ]);

        // Busca o pacote pelo código e o firsOrFail retorna erro se o codigo nao for encontrado no banco
        $pacote = Pacotes::where('codigo', $codigo)->firstOrFail();

        // Atualiza a quantidade e o status
        $pacote->quantidade = $request->quantidade;
        $pacote->status = ($pacote->quantidade === 0) ? 'colado' : 'estoque';
        $pacote->save();

        return redirect()->route('colagem')->with('success', 'Pacote atualizado com sucesso!');
    }

    public function colar($codigo)
    {
        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->firstOrFail();

        // Define a quantidade como 0 e atualiza o status
        $pacote->quantidade = 0;
        $pacote->status = 'colado';
        $pacote->save();

        return redirect()->route('colagem')->with('success', 'Pacote colado com sucesso!');
    }

    public function editar($codigo)
    {
        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->firstOrFail();

        // Opções fixas para os campos
        $comprimentos = [1850, 1250, 950, 650, 470]; // Comprimentos disponíveis
        $larguras = [144, 100]; // Larguras disponíveis
        $espessuras = [3.7, 2.5]; // Espessuras disponíveis
        $tipos = ['capa clara', 'capa escura', 'parte de tras sem furos', 'parte de tras com furos']; // Tipos fixos

        return view('admin.editar_pacote', compact('pacote', 'tipos', 'comprimentos', 'larguras', 'espessuras'));
    }

    public function atualizarPacote(Request $request, $codigo)
    {
        // Validação dos dados de atualização
        $request->validate([
            'tipo' => 'required|string|in:capa clara,capa escura,parte de tras sem furos,parte de tras com furos',
            'comprimento' => 'required|numeric',
            'largura' => 'required|numeric',
            'espessura' => 'required|numeric',
            'quantidade' => 'required|integer|min:0',
        ]);

        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->firstOrFail();

        // Atualiza os dados do pacote
        $pacote->tipo = $request->tipo;
        $pacote->comprimento = $request->comprimento;
        $pacote->largura = $request->largura;
        $pacote->espessura = $request->espessura;
        $pacote->quantidade = $request->quantidade;
        $pacote->status = ($pacote->quantidade === 0) ? 'colado' : 'estoque';
        $pacote->save();

        return redirect()->route('controle_estoque')->with('success', 'Pacote atualizado com sucesso!');
    }

    public function deletar($codigo)
    {
        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->firstOrFail();

        // Exclui o pacote
        $pacote->delete();

        return redirect()->route('controle_estoque')->with('success', 'Pacote excluído com sucesso!');
    }
}
