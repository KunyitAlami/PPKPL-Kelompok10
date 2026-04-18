<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>Daftar Pekerjaan Uji Sondir Lapangan</h2>
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">&larr; Kembali ke Dashboard</a>
    <br><br>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px; padding: 10px; border: 1px solid green;">{{ session('success') }}</div>
    @endif

    <h3 style="color: #d9534f;">&#9203; Antrean Uji Lapangan</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; margin-bottom: 30px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>ID Lokasi</th>
                <th>Proyek</th>
                <th>Koordinat (Lat, Lng)</th>
                <th>Tanggal Uji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($antrean as $jadwal)
                <tr>
                    <td>#{{ $jadwal->id }}</td>
                    <td>{{ $jadwal->soilTest->proyek->nama_proyek ?? 'Proyek '.$jadwal->soilTest->proyek_id }}</td>
                    <td>{{ $jadwal->latitude }}, {{ $jadwal->longitude }}</td>
                    <td>{{ $jadwal->tanggal_uji->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('teknisi.sondir.create', $jadwal->id) }}" style="padding: 5px 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 3px;">Input Nilai Sondir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada jadwal uji lapangan baru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3 style="color: #5cb85c;">&#9989; Riwayat Hasil Uji (Bisa Direvert)</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>ID Lokasi</th>
                <th>Nilai qc</th>
                <th>Nilai fs</th>
                <th>Indikator</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $r)
                <tr>
                    <td>#{{ $r->lokasi_id }}</td>
                    <td>{{ $r->nilai_qc }} kg/cm²</td>
                    <td>{{ $r->nilai_fs }} kg/cm²</td>
                    <td><strong>{{ $r->indikator_awal }}</strong></td>
                    <td>
                        <form action="{{ route('teknisi.sondir.revert', $r->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan hasil uji ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer; text-decoration: underline;">&#x21BA; Revert Input</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada riwayat uji.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>