<?php

namespace App\Http\Controllers;

use App\Models\SoilTestModel;
use App\Models\SoilCertificate;
use Illuminate\Http\Request;

class SoilCertificateController extends Controller
{
    public function create(SoilTestModel $soilTest)
    {
        return view('lab.certificate.upload', compact('soilTest'));
    }

    public function store(Request $request, SoilTestModel $soilTest)
    {
        // ❗ VALIDASI STATUS (WAJIB)
        if ($soilTest->status !== 'Menunggu Upload Sertifikat') {
            return back()->with('error', 'Belum ada hasil pengujian!');
        }

        $request->validate([
            'sertifikat_uji' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('sertifikat_uji');

        $path = $file->store('certificates', 's3');

        SoilCertificate::create([
            'pengajuan_uji_tanah_id' => $soilTest->id,
            'file_path' => $path
        ]);

        $soilTest->update([
            'status' => 'Terverifikasi'
        ]);

        return redirect()
            ->route('lab.lokasi.index')
            ->with('success', 'Sertifikat berhasil diupload');
    }
}