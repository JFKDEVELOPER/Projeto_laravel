<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacotes;

class PageController extends Controller
{
    public function home()
    {
        $featuredPosts = [
            ['title' => 'classificacao', 'content' => 'Página para registro de pacotes'],
            ['title' => 'colagem', 'content' => 'Página para controle de colagem'],
            ['title' => 'administracao', 'content' => 'Controle de estoque'],
        ];

        return view('pages.home', compact('featuredPosts'));
    }

    public function colagem()
    {
        $featuredPosts = [
            ['title' => 'colagem', 'content' => 'Página para controle de colagem'],
        ];

        return view('pages.colagem', compact('featuredPosts'));
    }

    public function classificacao()
    {
        $featuredPosts = [
            ['title' => 'classificacao', 'content' => 'Página para registro de pacotes'],
        ];

        return view('pages.classificacao', compact('featuredPosts'));
    }

    public function administracao()
    {
        $pacotes = Pacotes::all(); // Consulta para buscar todos os pacotes

        return view('admin.admpage', compact('pacotes'));
    }

    public function controleEstoque(Request $request) 
    {
        // Inicializa a consulta para o modelo Pacotes
        $query = Pacotes::query();
    
        // Filtra por tipo se especificado na requisição
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
    
        // Filtra por comprimento se especificado na requisição
        if ($request->filled('comprimento')) {
            $query->where('comprimento', $request->comprimento);
        }
    
        // Filtra por largura se especificado na requisição
        if ($request->filled('largura')) {
            $query->where('largura', $request->largura);
        }
    
        // Filtra por espessura se especificado na requisição
        if ($request->filled('espessura')) {
            $query->where('espessura', $request->espessura);
        }
    
        // Filtra por status se especificado na requisição
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Executa a consulta e obtém os pacotes filtrados
        $pacotes = $query->get();

        if ($pacotes->isEmpty()) {
            session()->flash('error', 'Nenhum pacote encontrado com os critérios especificados.');
        }
    
        // Busca as opções únicas para o filtro em ordem decrescente
        $tipos = Pacotes::distinct()->orderBy('tipo', 'asc')->pluck('tipo');
        $status = Pacotes::distinct()->orderBy('status', 'desc')->pluck('status');
        $comprimentos = Pacotes::distinct()->orderBy('comprimento', 'desc')->pluck('comprimento');
        $larguras = Pacotes::distinct()->orderBy('largura', 'desc')->pluck('largura');
        $espessuras = Pacotes::distinct()->orderBy('espessura', 'desc')->pluck('espessura');
    
        // Retorna a view 
        return view('admin.controle_estoque', compact('pacotes', 'tipos', 'status', 'comprimentos', 'larguras', 'espessuras'));
    }

    public function alterarPacote($codigo) 
    {
        // Busca o pacote pelo código
        $pacote = Pacotes::where('codigo', $codigo)->first();

        // Verifica se o pacote existe
        if (!$pacote) {
            // Retorna erro se nao encontrado
            return redirect()->route('administracao')->with('error', 'Pacote não encontrado.');
        }

        return view('admin.alterar_pacote', compact('pacote'));
    }

    public function login()
    {
        return view('login_pages.login', compact('featuredPosts'));
    }
}
