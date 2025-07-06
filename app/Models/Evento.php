<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'eventos';

    protected $fillable = [
        'user_id',
        'nome',
        'data_inscricao',
        'data_inicio',
        'data_fim',
        'local',
        'descricao'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trabalhos()
    {
        return $this->hasMany(Trabalho::class);
    }
}
