<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@impol.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'prof@impol.com'],
            [
                'name' => 'Professor João',
                'password' => Hash::make('prof123'),
                'role' => 'teacher',
            ]
        );

        User::firstOrCreate(
            ['email' => 'ana@impol.com'],
            [
                'name' => 'Estudante Ana',
                'password' => Hash::make('ana123'),
                'role' => 'student',
            ]
        );
    }
}