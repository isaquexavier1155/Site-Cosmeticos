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
        'tags',
        'modo_de_usar',
        'caracteristicas'
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    // Relacionamento com o modelo Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'produto_id');
    }
}
