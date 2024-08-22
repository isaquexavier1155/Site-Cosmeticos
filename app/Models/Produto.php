<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'preco_promocional',
        'quantidade_estoque',
        'categoria',
        'imagem',
        'imagens_adicionais',
        'ativo',
        'tags'
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];
}
