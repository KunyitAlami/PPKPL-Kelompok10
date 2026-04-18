<?php

namespace App\Http\Controllers;

use App\Actions\StoreSoilLocationAction;
use App\Http\Requests\StoreLocationRequest;
use App\Models\SoilTestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SoilLocationController extends Controller
{
    public function index(): View
    {
        // 1. Data yang masih menunggu (Antrean)
        $antrean = SoilTestModel::with('proyek')
                        ->where('status', 'Menunggu Penjadwalan Lab')
                        ->get();

        // 2. Data yang sudah dijadwalkan (Bisa di-revert/edit)
        $terjadwal = SoilTestModel::with(['proyek', 'location'])
                        ->where('status', 'Terjadwal')
                        ->get();
                            
        return view('lab.lokasi.index', compact('antrean', 'terjadwal'));
    }

    public function create(SoilTestModel $soilTest): View
    {
        return view('lab.lokasi.create', compact('soilTest'));
    }

    public function store(StoreLocationRequest $request, SoilTestModel $soilTest, StoreSoilLocationAction $action): RedirectResponse
    {
        // 1. Ambil data yang sudah lolos validasi ketat dari Request bawaanmu
        $data = $request->validated();
        
        // 2. Set ID Petugas Lab dari user yang sedang login
        $data['petugas_lab_id'] = Auth::id();

        // 3. Eksekusi penyimpanan dan update status menggunakan Action
        $action->execute($soilTest, $data);

        // 4. Kembali ke daftar jadwal lab
        return redirect()->route('lab.lokasi.index')
            ->with('success', 'Koordinat lokasi berhasil disimpan dan status menjadi Terjadwal.');
    }
    
    /**
     * Fitur Revert: Menghapus titik lokasi dan mengembalikan status ke 'Menunggu'
     */
    public function revert(SoilTestModel $soilTest): RedirectResponse
    {
        \DB::transaction(function () use ($soilTest) {
            // Hapus data lokasi terkait
            $soilTest->location()->delete();

            // Kembalikan status ke awal
            $soilTest->update(['status' => 'Menunggu Penjadwalan Lab']);
        });

        return back()->with('success', 'Jadwal telah dibatalkan dan dikembalikan ke antrean.');
    }
}