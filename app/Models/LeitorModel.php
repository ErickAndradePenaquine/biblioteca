<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeitorModel extends Model
{
    protected $table = 'leitor';
    protected $fillable = [ 
        'nome', 
        'cpf', 
        'email', 
        'telefone'
    ];
}
