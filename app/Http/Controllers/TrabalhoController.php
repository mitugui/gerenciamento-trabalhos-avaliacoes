<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrabalhoController extends Controller
{
    public function create(string $evento_id)
    {
        return view('trabalhos.create', compact('evento_id'));
    }

    public function store(Request $request, string $evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
    
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'resumo' => 'required|string|max:500',
        ], [
            'titulo.required' => 'O título do trabalho é obrigatório.',
            'resumo.required' => 'O resumo do trabalho é obrigatório.',
            'titulo.string' => 'O título do trabalho deve ser uma string.',
            'descricao.string' => 'A descrição do trabalho deve ser uma string.',
            'resumo.string' => 'O resumo do trabalho deve ser uma string.',
            'titulo.max' => 'O título do trabalho não pode exceder 255 caracteres.',
            'descricao.max' => 'A descrição do trabalho não pode exceder 1000 caracteres.',
            'resumo.max' => 'O resumo do trabalho não pode exceder 500 caracteres.',   
        ]);
        
        $trabalho = Trabalho::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'resumo' => $request->resumo,
            'evento_id' => $evento->id,
            'status' => 'pendente',
            'data_submissao' => now(),
        ]);

        $trabalho->alunos()->attach(Auth::user()->id);

        return redirect()->route('eventos.public')
            ->with('success', 'Trabalho cadastrado com sucesso!');
    }
}
