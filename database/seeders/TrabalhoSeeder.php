<?php

namespace Database\Seeders;

use App\Models\Trabalho;
use Illuminate\Database\Seeder;

class TrabalhoSeeder extends Seeder
{
    public function run(): void
    {
        Trabalho::create([
            'evento_id' => 1,
            'status' => 'pendente',
            'titulo' => 'Sistema de Gerenciamento de Biblioteca',
            'descricao' => 'Criar um sistema para cadastro, busca e empréstimo de livros utilizando Laravel.',
            'resumo' => 'O objetivo deste trabalho é desenvolver um sistema CRUD completo com autenticação e relacionamentos usando o framework Laravel.',
            'data_submissao' => now()->addDays(3),
        ]);

        Trabalho::create([
            'evento_id' => 2,
            'status' => 'pendente',
            'titulo' => 'Plataforma de Cursos Online com PHP',
            'descricao' => 'Desenvolver uma plataforma básica de cursos online, com funcionalidades de inscrição e listagem de aulas.',
            'resumo' => 'Este trabalho propõe a criação de um site onde usuários possam se inscrever em cursos fictícios e acessar conteúdo simulado.',
            'data_submissao' => now()->addDays(5),
        ]);
    }
}
