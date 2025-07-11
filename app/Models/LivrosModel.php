<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivrosModel extends Model
{
    protected $table = 'livros';

    protected $fillable = [
        'id',
        'titulo', 
        'autor', 
        'genero', 
        'ano_publicacao',
        'quantidade_total'
    ];
}
