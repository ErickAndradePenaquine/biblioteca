<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmprestimoModel extends Model
{
    protected $table = 'emprestimo';

    protected $fillable = [
        'leitor_id',
        'livro_id',
        'data_emprestimo',
        'data_prevista_devolucao',
        'data_devolucao',
        'status',
        'leitor_id',
        'livro_id'
    ];

    public function leitor()
    {
        return $this->belongsTo(LeitorModel::class, 'leitor_id');
    }

    public function livro()
    {
        return $this->belongsTo(LivrosModel::class, 'livro_id');
    }
}
