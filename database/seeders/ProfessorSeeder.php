<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ProfessorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $role = Role::where('nome', 'PROFESSOR')->first();

        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('senha123'),
                'role_id' => $role->id,
            ]);

            Professor::create([
                'user_id' => $user->id,
                'siape' => $faker->unique()->numerify('#######'),
            ]);
        }
    }
}
