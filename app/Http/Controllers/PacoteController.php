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
            'comprimento' => 'required|numeric', // Valida que o comprimento é um número
            'largura' => 'required|numeric',     // Valida que a largura é um número
            'espessura' => 'required|numeric',   // Valida que a espessura é um número
            'tipo' => 'required|string',
            'quantidade' => 'required|numeric',   // Valida que a quantidade é um número
        ]);

        // Gerar código de 4 dígitos e garantir que não se repita
        do {
            $codigo = mt_rand(1000, 9999); // Gera um número aleatório de 4 dígitos
        } while (Pacotes::where('codigo', $codigo)->exists()); // Verifica se o código já existe no banco de dados

        // Cria um novo pacote com os dados validados
        $pacote = new Pacotes();
        $pacote->comprimento = $request->comprimento; // Atribui comprimento
        $pacote->largura = $request->largura;         // Atribui largura
        $pacote->espessura = $request->espessura;     // Atribui espessura
        $pacote->tipo = $request->tipo;
        $pacote->codigo = $codigo;                    // Atribui o código gerado
        $pacote->quantidade = $request->quantidade;
        $pacote->status = ($pacote->quantidade === 0) ? 'colado' : 'estoque';
        $pacote->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('classificacao')->with('success', 'Pacote criado com sucesso! O ID do pacote é: ' . $codigo);

    }

    public function buscar(Request $request)
    {
        // Validação do código do pacote
        $request->validate([
            'codigo' => 'required|string|size:4', // Valida que o código deve ter exatamente 4 caracteres
        ]);

        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $request->codigo)->first();

        // Verifica se o pacote foi encontrado
        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']); // Redireciona com erro se não encontrado
        }

        // Retorna a view com os dados do pacote encontrado
        return view('pages.colagem', compact('pacote'));
    }

    public function atualizar(Request $request)
    {
        // Validação dos dados de atualização
        $request->validate([
            'codigo' => 'required|string|size:4', // Valida que o código deve ter exatamente 4 caracteres
            'quantidade' => 'required|numeric',    // Valida que a quantidade deve ser um número
        ]);

        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $request->codigo)->first();

        // Se o pacote não for encontrado, redirecione com erro
        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']); // Redireciona com erro se não encontrado
        }

        // Atualiza a quantidade
        $pacote->quantidade = $request->quantidade;

        // Verifica se a quantidade é 0 para atualizar o status
        $pacote->status = ($pacote->quantidade === 0) ? 'colado' : 'estoque';

        // Salva as alterações no banco de dados
        $pacote->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('colagem')->with('success', 'Pacote atualizado com sucesso!'); // Mensagem de sucesso
    }

    public function colar($codigo)
    {
        // Validação do código do pacote
        request()->validate([
            'codigo' => 'required|string|size:4', // Valida que o código deve ter exatamente 4 caracteres
        ]);

        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->first();

        // Se o pacote não for encontrado, redirecione com erro
        if (!$pacote) {
            return redirect()->route('colagem')->withErrors(['codigo' => 'Pacote não encontrado.']);
        }

        // Define a quantidade como 0 e atualiza o status
        $pacote->quantidade = 0;
        $pacote->status = 'colado';

        // Salva as alterações no banco de dados
        $pacote->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('colagem')->with('success', 'Pacote colado com sucesso!');
    }
}
