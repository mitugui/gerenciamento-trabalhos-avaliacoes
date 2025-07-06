<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeader extends Seeder
{
    public function run(): void
    {
        $roles = ['ADMIN', 'PROFESSOR', 'ALUNO'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'nome' => $role,
            ]);
        }
    }
}
