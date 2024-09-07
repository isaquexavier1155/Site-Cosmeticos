<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Definir a tabela associada ao modelo
    protected $table = 'cart';

    // Definir os campos que podem ser preenchidos em massa
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Definir os campos que devem ser tratados como data (para timestamp, se necessário)
    protected $dates = ['created_at', 'updated_at'];

    // Relacionamento com o modelo Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
