<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h1>Selamat Datang, {{ auth()->user()->nama }}</h1>
    <p>Role Anda saat ini adalah: <strong>{{ auth()->user()->role }}</strong></p>

    @if(auth()->user()->role === 'Kontraktor')
        <div style="margin: 20px 0; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9;">
            <h3>Menu Kontraktor</h3>
            <p>Silakan ajukan jadwal uji tanah untuk proyek Anda di sini:</p>
            <a href="{{ route('pengajuan.index') }}" style="display: inline-block; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Kelola Pengajuan Uji Tanah</a>
        </div>
    @endif

    @if(auth()->user()->role === 'PetugasLab')
        <div style="margin: 20px 0; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9;">
            <h3>Menu Petugas Lab</h3>
            <p>Silakan jadwalkan dan tentukan titik GPS uji tanah di sini:</p>
            <a href="{{ route('lab.lokasi.index') }}" style="display: inline-block; padding: 10px 15px; background-color: #17a2b8; color: white; text-decoration: none; border-radius: 5px;">Kelola Jadwal & Lokasi Uji</a>
        </div>
    @endif

    @if(auth()->user()->role === 'TeknisiLapangan')
        <div style="margin: 20px 0; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9;">
            <h3>Menu Teknisi Lapangan</h3>
            <p>Silakan input data hasil uji sondir lapangan di sini:</p>
            <a href="{{ route('teknisi.sondir.index') }}" style="display: inline-block; padding: 10px 15px; background-color: #ffc107; color: black; text-decoration: none; border-radius: 5px;">Input Hasil Sondir</a>
        </div>
    @endif

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" style="padding: 8px 15px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">Logout</button>
    </form>
</body>
</html>