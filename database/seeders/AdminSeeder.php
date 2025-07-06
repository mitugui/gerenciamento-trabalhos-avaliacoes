<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('nome', 'ADMIN')->first();
        
        User::firstOrCreate(
            ['email' => 'admin@admin'],
            [
                'name' => 'Admin',
                'email' => 'admin@admin',
                'password' => bcrypt('admin123'),
                'role_id' => $role->id,
            ]
        );
    }
}
