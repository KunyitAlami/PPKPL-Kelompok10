<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Uji Tanah</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f5f5f5;">

<div style="width: 90%; max-width: 900px; margin: 30px auto; background: white; padding: 20px; border: 1px solid #ccc;">

    <h2>Manajemen Lokasi Uji Tanah</h2>

    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: blue;">
        ← Kembali ke Dashboard
    </a>

    @if(session('success'))
        <div style="margin-top: 15px; padding: 10px; border: 1px solid green; color: green;">
            {{ session('success') }}
        </div>
    @endif


    {{-- ================= BELUM ADA LOKASI ================= --}}
    <h3 style="margin-top: 20px; color: red;">Pengajuan Belum Ada Lokasi</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 10px; border-collapse: collapse;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>ID</th>
                <th>Jenis Pengujian</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($belum as $soilTest)
                <tr>
                    <td>#{{ $soilTest->id }}</td>
                    <td>{{ $soilTest->jenis_pengujian }}</td>
                    <td>
                        <a href="{{ route('lokasi.create', $soilTest->id) }}">
                            Input Lokasi
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">
                        Semua pengajuan sudah punya lokasi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>


        {{-- ================= SUDAH ADA LOKASI ================= --}}
        <h3 style="margin-top: 30px; color: green;">Pengajuan Sudah Ada Lokasi</h3>

        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 10px; border-collapse: collapse;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>ID Pengajuan</th>
                    <th>Jenis Pengujian</th>
                    <th>Kontraktor ID</th>
                    <th>Petugas Lapangan ID</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Tanggal Uji</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sudah as $soilTest)
                    <tr>
                        <td>#{{ $soilTest->id }}</td>

                        <td>{{ $soilTest->jenis_pengujian }}</td>

                        <td>{{ $soilTest->kontraktor_id }}</td>

                        <td>{{ $soilTest->location->petugas_lapangan_id }}</td>

                        <td>{{ $soilTest->location->latitude }}</td>

                        <td>{{ $soilTest->location->longitude }}</td>

                        <td>
                            {{ $soilTest->location->tanggal_uji->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">
                            Belum ada lokasi tersimpan
                        </td>
                    </tr>
                @endforelse
            </tbody>
</table>

</div>

</body>
</html>