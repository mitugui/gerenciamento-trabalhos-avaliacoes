<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabalho extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trabalhos';

    protected $fillable = [
        'evento_id',
        'status',
        'titulo',
        'descricao',
        'resumo',
        'data_submissao'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_trabalho', 'trabalho_id', 'aluno_id');
    }

    public function avaliacoes()
    {
        return $this->hasOne(Avaliacao::class);
    }
}
