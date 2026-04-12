<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoilTestModel;

class SoilTestSeeder extends Seeder
{
    public function run(): void
    {
        SoilTestModel::create([
            'proyek_id' => 1,
            'kontraktor_id' => 1,
            'jenis_pengujian' => 'Uji Tanah',
            'status' => 'pending',
        ]);
    }
}