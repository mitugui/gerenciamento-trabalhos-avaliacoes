<?php

namespace Database\Seeders;

use App\Models\Aluno;
use Illuminate\Database\Seeder;

class AlunoTrabalhoSeeder extends Seeder
{
    public function run(): void
{
    $aluno = Aluno::first();

    if ($aluno) {
        $trabalhoIds = [1, 2];

        foreach ($trabalhoIds as $trabalhoId) {
            $aluno->trabalhos()->attach($trabalhoId);
        }
    }
}
}
