<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEstoque extends Model
{
    use HasFactory;

    // Defina a tabela se não seguir a convenção do Laravel
    protected $table = 'itens_estoque'; 

    // Defina os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'tamanho',
        'quantidade',
        'status',
    ];
}
