<?php

namespace App\Http\Controllers;

use App\Models\SoilTestModel;
use App\Models\SoilLocationModel;
use App\Models\HasilSondirModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeknisiSondirController extends Controller
{
    public function index()
    {
        // 1. Antrean: Jadwal yang belum diinput nilai sondirnya
        $antrean = SoilLocationModel::with('soilTest.proyek')
            ->whereHas('soilTest', function($q) {
                $q->where('status', 'Terjadwal');
            })->get();

        // 2. Riwayat: Hasil uji yang sudah diinput, tapi belum diproses oleh Lab (bisa direvert)
        $riwayat = HasilSondirModel::with(['lokasi.soilTest.proyek'])
            ->whereHas('lokasi.soilTest', function($q) {
                $q->where('status', 'Menunggu Upload Sertifikat');
            })->get();

        return view('teknisi.sondir.index', compact('antrean', 'riwayat'));
    }

    public function create(SoilLocationModel $lokasi)
    {
        return view('teknisi.sondir.create', compact('lokasi'));
    }

    public function store(Request $request, SoilLocationModel $lokasi)
    {
        $request->validate([
            'nilai_qc' => 'required|numeric|min:0',
            'nilai_fs' => 'required|numeric|min:0',
        ]);

        $qc = $request->nilai_qc;
        if ($qc < 20) {
            $indikator = 'Rendah (Tanah Lunak)';
        } elseif ($qc <= 50) {
            $indikator = 'Sedang (Tanah Sedang)';
        } else {
            $indikator = 'Tinggi (Tanah Keras)';
        }

        DB::transaction(function () use ($request, $lokasi, $indikator) {
            HasilSondirModel::create([
                'lokasi_id' => $lokasi->id,
                'teknisi_id' => Auth::id(),
                'nilai_qc' => $request->nilai_qc,
                'nilai_fs' => $request->nilai_fs,
                'indikator_awal' => $indikator,
            ]);

            $lokasi->soilTest->update([
                'status' => 'Menunggu Upload Sertifikat' 
            ]);
        });

        return redirect()->route('teknisi.sondir.index')
            ->with('success', "Hasil uji berhasil disimpan. Indikator tanah: $indikator");
    }

    /**
     * Fitur Revert: Menghapus data sondir dan mengembalikan status
     */
    public function revert(HasilSondirModel $hasil)
    {
        DB::transaction(function () use ($hasil) {
            // 1. Kembalikan status pengajuan ke 'Terjadwal'
            $hasil->lokasi->soilTest->update([
                'status' => 'Terjadwal'
            ]);

            // 2. Hapus data hasil sondir yang salah
            $hasil->delete();
        });

        return back()->with('success', 'Data hasil uji sondir berhasil dibatalkan dan dikembalikan ke antrean.');
    }
}