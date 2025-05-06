<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

/*     protected $fillable = [
        'name',
        'email',
        'cpf',
        'celular',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'password',
        'is_admin', // Certifique-se de que isso está incluído
    ]; */

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'celular',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->is_admin == 1; // Método para verificar se o usuário é admin
    }
}
