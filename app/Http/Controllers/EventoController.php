<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $validationRules = [
            'nome' => 'required|string|max:255',
            'data_inscricao' => 'required|date|before:data_inicio|after:now',
            'data_inicio' => 'required|date|after:data_inscricao',
            'data_fim' => 'required|date|after:data_inicio',
            'local' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000'
        ];
        
        $validationMessages = [
            'nome.required' => 'O nome do evento é obrigatório.',
            'nome.string' => 'O nome do evento deve ser um texto.',
            'nome.max' => 'O nome do evento não pode ter mais de 255 caracteres.',

            'data_inscricao.required' => 'A data de inscrição é obrigatória.',
            'data_inscricao.date' => 'A data de inscrição deve ser uma data válida.',
            'data_inscricao.before' => 'A data de inscrição deve ser anterior à data de início.',
            'data_inscricao.after' => 'A data de inscrição deve ser posterior ao momento atual.',

            'data_inicio.required' => 'A data de início é obrigatória.',
            'data_inicio.date' => 'A data de início deve ser uma data válida.',
            'data_inicio.after' => 'A data de início deve ser posterior à data de inscrição.',

            'data_fim.required' => 'A data de fim é obrigatória.',
            'data_fim.date' => 'A data de fim deve ser uma data válida.',
            'data_fim.after' => 'A data de fim deve ser posterior à data de início.',

            'local.required' => 'O local do evento é obrigatório.',
            'local.string' => 'O local do evento deve ser um texto.',
            'local.max' => 'O local do evento não pode ter mais de 255 caracteres.',

            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ];

        $request->validate($validationRules, $validationMessages);

        Evento::create([
            'user_id' => auth()->id(),
            'nome' => $request->nome,
            'data_inscricao' => $request->data_inscricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'local' => $request->local,
            'descricao' => $request->descricao,
        ]);       

        return redirect()->route('eventos.index')->with('success', 'Evento criado com sucesso!');
    }

    public function edit(string $id)
    {
        return view('eventos.edit', [
            'evento' => Evento::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $evento = Evento::findOrFail($id);

        $rules = [
            'nome' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
        ];
        
        $messages = [
            'nome.required' => 'O nome do evento é obrigatório.',
            'nome.string' => 'O nome do evento deve ser um texto.',
            'nome.max' => 'O nome do evento não pode ter mais de 255 caracteres.',

            'local.required' => 'O local do evento é obrigatório.',
            'local.string' => 'O local do evento deve ser um texto.',
            'local.max' => 'O local do evento não pode ter mais de 255 caracteres.',

            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ];

        if (Carbon::parse($evento->data_inscricao)->isFuture()) {
            $rules['data_inscricao'] = 'required|date|before:data_inicio|after:now';
            $messages['data_inscricao.required'] = 'A data de inscrição é obrigatória.';
            $messages['data_inscricao.date'] = 'A data de inscrição deve ser uma data válida.';
            $messages['data_inscricao.before'] = 'A data de inscrição deve ser anterior à data de início.';
            $messages['data_inscricao.after'] = 'A data de inscrição deve ser posterior ao momento atual.';
        }

        if (Carbon::parse($evento->data_inicio)->isFuture()) {
            $rules['data_inicio'] = 'required|date|after:data_inscricao';
            $messages['data_inicio.required'] = 'A data de início é obrigatória.';
            $messages['data_inicio.date'] = 'A data de início deve ser uma data válida.';
            $messages['data_inicio.after'] = 'A data de início deve ser posterior à data de inscrição.';
        }

        if (Carbon::parse($evento->data_fim)->isFuture()) {
            $rules['data_fim'] = 'required|date|after:data_inicio';
            $messages['data_fim.required'] = 'A data de fim é obrigatória.';
            $messages['data_fim.date'] = 'A data de fim deve ser uma data válida.';
            $messages['data_fim.after'] = 'A data de fim deve ser posterior à data de início.';
        }

        $request->validate($rules, $messages);

        $dados = $request->only(['nome', 'local', 'descricao']);

        if (isset($rules['data_inscricao'])) {
            $dados['data_inscricao'] = $request->input('data_inscricao');
        }
        if (isset($rules['data_inicio'])) {
            $dados['data_inicio'] = $request->input('data_inicio');
        }
        if (isset($rules['data_fim'])) {
            $dados['data_fim'] = $request->input('data_fim');
        }

        $evento->update($dados);

        return redirect()->route('eventos.index')->with('success', 'Evento atualizado com sucesso!');
    }


    public function destroy(string $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento excluído com sucesso!');
    }
}
