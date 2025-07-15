<?php

namespace App\Http\Controllers;

use App\Mail\TrabalhoAvaliado;
use App\Models\Avaliacao;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AvaliacaoController extends Controller
{
    public function evaluate(string $id) {
        $trabalho = Trabalho::findOrFail($id);

        return view('avaliacao.evaluate', compact('trabalho'));
    }

    public function storeEvaluation(Request $request, $trabalho_id)
    {
        $request->validate([
            'descricao' => 'nullable|string|max:1000',
            'nota' => 'required|numeric|min:0|max:10',
            'status' => 'required|string|in:aprovado,rejeitado', 
        ], [
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',
            'descricao.string' => 'A descrição deve ser uma string.',
            'nota.required' => 'A nota é obrigatória.',
            'nota.numeric' => 'A nota deve ser um número.',
            'nota.min' => 'A nota deve ser pelo menos 0.',
            'nota.max' => 'A nota não pode ser maior que 10.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser aprovado ou rejeitado.',
        ]);

        $avaliacao = Avaliacao::create([
            'trabalho_id' => $trabalho_id,
            'professor_id' => Auth::user()->id,
            'descricao' => $request->descricao,
            'nota' => $request->nota,
        ]);

        $avaliacao->trabalho->update([
            'status' => $request->status,
        ]);

        $this->evaluationConcludedMailSend($avaliacao->trabalho);

        return redirect()->route('trabalhos.evaluation')->with('success', 'Avaliação realizada com sucesso!');
    }

    private function evaluationConcludedMailSend($trabalho)
    {
        foreach ($trabalho->alunos as $aluno) {
            Mail::to($aluno->user->email)->send(new TrabalhoAvaliado($trabalho, $trabalho->avaliacoes));
        }
    }
}
