<?php

namespace App\Http\Controllers;

use App\Models\SoilTestModel;
use App\Models\SoilLocationModel;
use App\Http\Requests\StoreLocationRequest;
use Illuminate\Support\Facades\Auth;

class PetugasLapanganController extends Controller
{
    public function index()
    {
        $belum = SoilTestModel::doesntHave('location')->get();

        $sudah = SoilTestModel::has('location')->get();

        return view('locations.cek_pengajuan', compact('belum', 'sudah'));
    }

    public function create(SoilTestModel $soilTest)
    {
        return view('locations.create', compact('soilTest'));
    }

    public function store(StoreLocationRequest $request, SoilTestModel $soilTest)
    {
        SoilLocationModel::create([
            'pengajuan_id' => $soilTest->id,
            'petugas_lapangan_id' => Auth::id(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal_uji' => $request->tanggal_uji,
        ]);

        // 🔥 WAJIB INI
        $soilTest->update([
            'status' => 'Terjadwal'
        ]);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil disimpan');
    }
}