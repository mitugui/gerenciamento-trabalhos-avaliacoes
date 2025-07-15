<?php

namespace App\Http\Controllers;

use App\Models\Professor;

class ProfessorController extends Controller
{
    public function adminIndex()
    {
        $professores = Professor::all();
        return view('professores.admin.index', compact('professores'));
    }

    public function patch(Professor $professor)
    {
        $professor->pode_avaliar = !$professor->pode_avaliar;
        $professor->save();

        return redirect()->route('admin.professores.index')->with('success', 'Status do professor atualizado com sucesso.');
    }
}
