<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pengajuan</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Riwayat Pengajuan Uji Tanah</h2>
    
    <div style="margin-bottom: 20px;">
        <a href="{{ route('dashboard') }}" style="margin-right: 15px; text-decoration: none;">&larr; Kembali ke Dashboard</a>
        <a href="{{ route('pengajuan.create') }}" style="padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">+ Buat Pengajuan Baru</a>
    </div>

    @if(session('success'))
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>No Pengajuan</th>
                <th>Proyek ID</th>
                <th>Jenis Pengujian</th>
                <th>Status</th>
                <th>Tanggal Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuans as $p)
                <tr>
                    <td>#{{ $p->id }}</td>
                    <td>Proyek ID: {{ $p->proyek_id }}</td> 
                    <td>{{ $p->jenis_pengujian }}</td>
                    <td><strong>{{ $p->status }}</strong></td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data pengajuan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>