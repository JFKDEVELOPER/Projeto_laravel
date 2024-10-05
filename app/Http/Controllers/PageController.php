<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        ['title' => 'classificacao', 'content' => 'Pagina para registro de pacotes'],
        
    ];

    return view('pages.classificacao', compact('featuredPosts'));
}

public function administracao() {
    return view('admin.admpage');
}
}