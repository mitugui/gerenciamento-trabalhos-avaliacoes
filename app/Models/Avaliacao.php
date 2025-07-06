<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'avaliacoes';

    protected $fillable = [
        'trabalho_id',
        'professor_id',
        'status',
        'comentario',
        'nota',
    ];

    public function trabalho()
    {
        return $this->belongsTo(Trabalho::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id', 'user_id');
    }
}
