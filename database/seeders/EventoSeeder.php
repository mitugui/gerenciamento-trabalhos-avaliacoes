<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    public function run(): void
    {
        Evento::create([
            'user_id' => 1,
            'nome' => 'Evento de Teste',
            'descricao' => 'Descrição do evento de teste',
            'data_inscricao' => now(),
            'data_inicio' => now()->addDays(10),
            'data_fim' => now()->addDays(12),
            'local' => 'Auditório Principal',
        ]);
        
        Evento::create([
            'user_id' => 1,
            'nome' => 'Workshop de Desenvolvimento',
            'descricao' => 'Workshop sobre desenvolvimento web',
            'data_inscricao' => now(),
            'data_inicio' => now()->addDays(10),
            'data_fim' => now()->addDays(12),
            'local' => 'Sala de Aula 101',
        ]);
    }
}
