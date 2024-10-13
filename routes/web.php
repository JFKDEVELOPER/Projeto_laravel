<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PacoteController;

// Página inicial
Route::get('/', [PageController::class, 'home'])->name('home');

// Página de colagem
Route::get('colagem', [PageController::class, 'colagem'])->name('colagem');
Route::post('colagem/buscar', [PacoteController::class, 'buscar'])->name('colagem.buscar');
Route::post('colagem/atualizar/{codigo}', [PacoteController::class, 'atualizar'])->name('colagem.atualizar');
Route::post('colagem/colar/{codigo}', [PacoteController::class, 'colar'])->name('colagem.colar');

// Página de classificação
Route::get('classificacao', [PageController::class, 'classificacao'])->name('classificacao');
Route::post('classificacao', [PacoteController::class, 'store'])->name('classificacao.store');

// Página de administração
Route::get('admin', [PageController::class, 'administracao'])->name('administracao');

// Página de controle de estoque
Route::get('controle_estoque', [PageController::class, 'controleEstoque'])->name('controle_estoque');

// Rota para editar pacote
Route::get('alterar_pacote/{codigo}', [PacoteController::class, 'editar'])->name('alterar_pacote');
Route::put('atualizar_pacote/{codigo}', [PacoteController::class, 'atualizarPacote'])->name('atualizar_pacote'); // Alterada para PUT

// Rota para excluir um pacote
Route::delete('pacotes/{codigo}', [PacoteController::class, 'deletar'])->name('deletar_pacote');
