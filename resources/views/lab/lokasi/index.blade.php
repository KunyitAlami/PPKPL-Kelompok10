<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>Manajemen Jadwal & Lokasi Uji</h2>
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">&larr; Dashboard</a>

    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 15px 0;">{{ session('success') }}</div>
    @endif

    <h3 style="color: #d9534f;">&#9203; Antrean Pengajuan (Menunggu Koordinat)</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-bottom: 30px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>No</th>
                <th>Proyek</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($antrean as $p)
                <tr>
                    <td>#{{ $p->id }}</td>
                    <td>{{ $p->proyek->nama_proyek ?? 'Proyek '.$p->proyek_id }}</td>
                    <td><a href="{{ route('lab.lokasi.create', $p->id) }}">Set Koordinat GPS</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="color: #5cb85c;">&#9989; Sudah Terjadwal</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>No</th>
                <th>Lokasi GPS (Lat, Lng)</th>
                <th>Tanggal Uji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($terjadwal as $p)
                <tr>
                    <td>#{{ $p->id }}</td>
                    <td>{{ $p->location->latitude }}, {{ $p->location->longitude }}</td>
                    <td>{{ $p->location->tanggal_uji->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('lab.lokasi.revert', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan jadwal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: red; cursor: pointer;">&#x21BA; Revert (Batalkan)</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>