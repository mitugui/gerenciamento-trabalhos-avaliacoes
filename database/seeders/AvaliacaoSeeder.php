<?php

namespace Database\Seeders;

use App\Models\Avaliacao;
use Illuminate\Database\Seeder;

class AvaliacaoSeeder extends Seeder
{
    public function run(): void
    {
        Avaliacao::create([
            'trabalho_id' => 1,
            'professor_id' => 2,
            'descricao' => 'Excelente trabalho, bem estruturado e com bom conteúdo.',
            'nota' => 9.5,
        ]);
    }
}
