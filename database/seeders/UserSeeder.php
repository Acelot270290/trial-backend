<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'codigo' => 'ADM001',
            'name' => 'Admin',
            'usuario' => 'Acelot',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456789'), 
            'ativo' => true,
        ]);

        User::factory()->count(10)->create();
    }
}
