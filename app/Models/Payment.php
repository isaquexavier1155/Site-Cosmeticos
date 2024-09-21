<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Nome da tabela associada ao modelo
    protected $table = 'payments';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'valor', 
        'user_id', 
        'status', 
        'quantidade_produtos', 
        'id_produtos',
        'frete_selecionado',
        'status_payment'
    ];

    // Se sua tabela não tiver timestamps, defina como false
    public $timestamps = true;

    // Se você usa uma chave primária diferente de 'id', defina aqui
    protected $primaryKey = 'id';

    // Se a chave primária não for auto-incrementada, defina como false
    public $incrementing = true;

    // Se a chave primária for do tipo string, defina o tipo
    protected $keyType = 'int';

    // Método para adicionar um pagamento
     // Método para adicionar um pagamento
     public static function addPayment($valor, $user_id, $produto_ids_json, $produto_qtds_json, $frete_selecionado, $status_payment)
     {
         // Cria um novo pagamento ao preencher formulário de Dados de Entrega
         // Seta status do pagamento e adiciona os campos de produtos
         $payment = self::create([
             'valor' => $valor,
             'user_id' => $user_id,
             'quantidade_produtos' => $produto_qtds_json,
             'id_produtos' => $produto_ids_json,
             'frete_selecionado' => $frete_selecionado, // Armazena a opção de frete selecionada
             'status_payment' => $status_payment
            ]);
 
         // Retorna o ID do pagamento recém-criado
         return $payment->id;
     }
    // Método para obter um pagamento por ID
    public static function getPayment($id)
    {
        // Encontra o pagamento pelo ID
        return self::find($id);
    }

    // Método para atualizar o status do pagamento
    public function setStatusPayment($status)
    {
        // Atualiza o status do pagamento
        $this->status = $status;
        return $this->save();
    }
}
