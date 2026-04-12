<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'nama' => 'Petugas Lab',
                'password' => Hash::make('password'),
                'role' => 'PetugasLab'
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nama' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
    }
}