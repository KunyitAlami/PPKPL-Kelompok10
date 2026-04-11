<?php

namespace App\Actions;

use App\Models\SoilTest;
use App\Models\SoilLocation;
use App\Models\SoilLocationModel;
use App\Models\SoilTestModel;
use Illuminate\Support\Facades\DB;

class StoreSoilLocationAction
{
    public function execute(SoilTestModel $soilTest, array $data): SoilLocationModel
    {
        return DB::transaction(function () use ($soilTest, $data) {
            return $soilTest->location()->create([
                'petugas_lab_id' => $data['petugas_lab_id'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'tanggal_uji' => $data['tanggal_uji'],
            ]);
        });
    }
}