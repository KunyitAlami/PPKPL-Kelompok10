<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>Manajemen Jadwal & Lokasi Uji</h2>
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">&larr; Dashboard</a>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 15px 0;">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div style="color: red; padding: 10px; border: 1px solid red; margin: 15px 0;">
            {{ session('error') }}
        </div>
    @endif


    {{-- ================= ANTREAN ================= --}}
    <h3 style="color: #d9534f;">⏳ Antrean Pengajuan (Menunggu Koordinat)</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-bottom: 30px;">
        <tr>
            <th>No</th>
            <th>Proyek</th>
            <th>Aksi</th>
        </tr>

        @forelse($antrean as $p)
            <tr>
                <td>#{{ $p->id }}</td>
                <td>{{ $p->proyek->nama_proyek ?? 'Proyek '.$p->proyek_id }}</td>
                <td>
                    <a href="{{ route('lab.lokasi.create', $p->id) }}">
                        Set Koordinat GPS
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Tidak ada antrean.</td></tr>
        @endforelse
    </table>


    {{-- ================= SIAP UPLOAD ================= --}}
    <h3 style="color: orange;">📄 Data Siap Upload Sertifikat</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-bottom: 30px;">
        <tr>
            <th>No</th>
            <th>Lokasi GPS</th>
            <th>Tanggal Uji</th>
            <th>Aksi</th>
        </tr>

        @forelse($siapUpload as $p)
            <tr>
                <td>#{{ $p->id }}</td>
                <td>{{ $p->location->latitude }}, {{ $p->location->longitude }}</td>
                <td>{{ $p->location->tanggal_uji->format('d M Y') }}</td>

                <td>
                    <a href="{{ route('lab.certificate.create', $p->id) }}"
                       style="padding:5px 10px; background:orange; color:black; text-decoration:none;">
                        Upload Sertifikat
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada data siap upload.</td></tr>
        @endforelse
    </table>


    {{-- ================= SUDAH SELESAI ================= --}}
    <h3 style="color: green;">✔ Data Sudah Terverifikasi</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <tr>
            <th>No</th>
            <th>Lokasi GPS</th>
            <th>Tanggal Uji</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse($selesai as $p)
            <tr>
                <td>#{{ $p->id }}</td>
                <td>{{ $p->location->latitude }}, {{ $p->location->longitude }}</td>
                <td>{{ $p->location->tanggal_uji->format('d M Y') }}</td>
                <td style="color: green;">✔ Terverifikasi</td>
                <td>
                    <form action="{{ route('lab.notify', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit"
                                style="padding: 6px 10px; background-color: #007bff; color: white; border: none; cursor: pointer;">
                            Kirim Notifikasi
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada data selesai.</td></tr>
        @endforelse
    </table>

</div>