<?php

namespace App\Http\Controllers;

use App\Actions\StoreSoilLocationAction;
use App\Http\Requests\StoreLocationRequest;
use App\Models\SoilLocationModel;
use App\Models\SoilTestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class SoilLocationController extends Controller
{
    /**
     * Tampilkan halaman input lokasi
     * 
     */
    public function create(SoilTestModel $soilTest = null): View
    {
        $soilTest = $soilTest ?? SoilTestModel::first();

        return view('locations.create', compact('soilTest'));
    }

    /**
     * Simpan lokasi
     */
    public function store(StoreLocationRequest $request, SoilTestModel $soilTest = null, StoreSoilLocationAction $action): RedirectResponse
    {
        $data = $request->validated();

        $data['petugas_lab_id'] = 1;


        $soilTest = $soilTest ?? SoilTestModel::first();

        if (!$soilTest) {
            return back()->with('error', 'Data pengajuan belum ada, silakan buat dulu.');
        }

        $data['pengajuan_id'] = $request->pengajuan_id;

        if (!$data['pengajuan_id']) {
            return back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        $location = SoilLocationModel::create($data);

        return redirect()->route('locations.show', $location->id)
            ->with('success', 'Koordinat lokasi berhasil disimpan.');
    }

    /**
     * Tampilkan detail lokasi
     */
    public function show(SoilLocationModel $location): View
    {
        return view('locations.show', compact('location'));
    }
}