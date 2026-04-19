<?php

namespace App\Http\Controllers;

use App\Actions\StoreSoilLocationAction;
use App\Http\Requests\StoreLocationRequest;
use App\Models\SoilTestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SoilLocationController extends Controller
{
    public function index(): View
    {
        // 1. Antrean
        $antrean = SoilTestModel::with('proyek')
            ->where('status', 'Menunggu Penjadwalan Lab')
            ->get();

        // 2. Sudah ada hasil uji → siap upload
        $siapUpload = SoilTestModel::with(['proyek', 'location'])
            ->where('status', 'Menunggu Upload Sertifikat')
            ->get();

        // 3. Sudah upload sertifikat
        $selesai = SoilTestModel::with(['proyek', 'location'])
            ->where('status', 'Terverifikasi')
            ->get();

        return view('lab.lokasi.index', compact('antrean', 'siapUpload', 'selesai'));
    }

    public function create(SoilTestModel $soilTest): View
    {
        return view('lab.lokasi.create', compact('soilTest'));
    }

    public function store(
        StoreLocationRequest $request,
        SoilTestModel $soilTest,
        StoreSoilLocationAction $action
    ): RedirectResponse {
        $data = $request->validated();
        $data['petugas_lab_id'] = Auth::id();

        $action->execute($soilTest, $data);

        return redirect()
            ->route('lab.lokasi.index')
            ->with('success', 'Koordinat lokasi berhasil disimpan dan status menjadi Terjadwal.');
    }

    public function revert(SoilTestModel $soilTest): RedirectResponse
    {
        DB::transaction(function () use ($soilTest) {
            $soilTest->location()->delete();
            $soilTest->update([
                'status' => 'Menunggu Penjadwalan Lab'
            ]);
        });

        return back()->with('success', 'Jadwal telah dibatalkan dan dikembalikan ke antrean.');
    }
}