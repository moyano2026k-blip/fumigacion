<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Tecnico',
            'email' => 'tecnico@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'tecnico'
        ]);

        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'usuario'
        ]);
    }
}