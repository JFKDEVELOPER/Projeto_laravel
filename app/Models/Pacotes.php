<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacotes extends Model
{
    use HasFactory;

    protected $fillable = ['comprimento', 'largura', 'espessura', 'tipo', 'quantidade', 'codigo'];
}
