<?php

namespace App\Actions;

use App\Models\SoilLocationModel;
use App\Models\SoilTestModel;
use Illuminate\Support\Facades\DB;

class StoreSoilLocationAction
{
    public function execute(SoilTestModel $soilTest, array $data): SoilLocationModel
    {
        return DB::transaction(function () use ($soilTest, $data) {
            
            // 1. Simpan titik koordinat
            $location = $soilTest->location()->create([
                'petugas_lab_id' => $data['petugas_lab_id'],
                'latitude'       => $data['latitude'],
                'longitude'      => $data['longitude'],
                'tanggal_uji'    => $data['tanggal_uji'],
            ]);

            // 2. Update status pengajuan menjadi Terjadwal (Requirement US 1.2)
            $soilTest->update([
                'status' => 'Terjadwal'
            ]);

            return $location;
        });
    }
}