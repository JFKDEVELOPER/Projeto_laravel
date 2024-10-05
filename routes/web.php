<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('colagem', [PageController::class, 'colagem'])->name('colagem');
Route::get('classificacao', [PageController::class, 'classificacao'])->name('classificacao');
Route::get('admin', [PageController::class, 'administracao'])->name('administracao');   