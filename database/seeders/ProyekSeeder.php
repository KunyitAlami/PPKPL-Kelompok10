<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyekModel;

class ProyekSeeder extends Seeder
{
    public function run(): void
    {
        ProyekModel::create([
            'pemilik_id' => 5, // pastikan user id 1 ada
            'nama_proyek' => 'Proyek Uji Tanah',
            'lokasi' => 'Banjarmasin',
            'status' => 'aktif',
        ]);
    }
}