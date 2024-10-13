<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PacoteController;

// Página inicial
Route::get('/', [PageController::class, 'home'])->name('home');

// Página de colagem
Route::get('colagem', [PageController::class, 'colagem'])->name('colagem');
Route::post('colagem/buscar', [PacoteController::class, 'buscar'])->name('colagem.buscar');
Route::post('colagem/atualizar', [PacoteController::class, 'atualizar'])->name('colagem.atualizar');
Route::post('colagem/colar/{codigo}', [PacoteController::class, 'colar'])->name('colagem.colar');

// Página de classificação
Route::get('classificacao', [PageController::class, 'classificacao'])->name('classificacao');
Route::post('classificacao', [PacoteController::class, 'store'])->name('classificacao.store');

// Página de administração
Route::get('admin', [PageController::class, 'administracao'])->name('administracao');

// Página de controle de estoque
Route::get('controle_estoque', [PageController::class, 'controleEstoque'])->name('controle_estoque');

// Página de alteração de pacotes
Route::get('alterar_pacotes', [PageController::class, 'alteracaoPacotes'])->name('alterar_pacotes');
