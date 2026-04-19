<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nama' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // 2. Petugas Lab (Actor: Petugas Lab Tanah)
        User::firstOrCreate(
            ['email' => 'lab@example.com'],
            [
                'nama' => 'Petugas Lab Tanah',
                'password' => Hash::make('password'),
                'role' => 'PetugasLab'
            ]
        );

        // 3. Kontraktor (Actor: Kontraktor)
        User::firstOrCreate(
            ['email' => 'kontraktor@example.com'],
            [
                'nama' => 'Budi Kontraktor',
                'password' => Hash::make('password'),
                'role' => 'Kontraktor'
            ]
        );

        // 4. Teknisi Lapangan (Actor: Teknisi Lapangan untuk US 1.3)
        User::firstOrCreate(
            ['email' => 'teknisi@example.com'],
            [
                'nama' => 'Andi Teknisi',
                'password' => Hash::make('password'),
                'role' => 'TeknisiLapangan'
            ]
        );

        // 5. Pemilik Rumah (Actor: Pemilik Rumah untuk US 1.5)
        User::firstOrCreate(
            ['email' => 'pemilik@example.com'],
            [
                'nama' => 'Siti Pemilik Rumah',
                'password' => Hash::make('password'),
                'role' => 'PemilikRumah'
            ]
        );

        // 6. Petugas Lapangan (Actor: Petugas Lapangan untuk US 1.2)
        User::firstOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'nama' => 'Ahmad Petugas Lapangan',
                'password' => Hash::make('password'),
                'role' => 'PetugasLapangan'
            ]
        );
    }
}