<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeader::class,
            AdminSeeder::class,
            EventoSeeder::class,
            ProfessorSeeder::class,
            AlunoSeeder::class,
            TrabalhoSeeder::class,
            AlunoTrabalhoSeeder::class,
            AvaliacaoSeeder::class
        ]);
    }
}
