<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

<div class="max-w-5xl mx-auto p-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Selamat Datang, {{ auth()->user()->nama }}
        </h1>
        <p class="text-gray-600">
            Role Anda:
            <span class="font-semibold text-blue-600">
                {{ auth()->user()->role }}
            </span>
        </p>
    </div>

    <!-- Kontraktor -->
    @if(auth()->user()->role === 'Kontraktor')
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-5">
        <h3 class="text-lg font-semibold mb-2">Menu Kontraktor</h3>
        <p class="text-gray-600 mb-4">
            Silakan ajukan jadwal uji tanah untuk proyek Anda di sini:
        </p>
        <a href="{{ route('pengajuan.index') }}"
           class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            Kelola Pengajuan Uji Tanah
        </a>
    </div>
    @endif

    <!-- Petugas Lab -->
    @if(auth()->user()->role === 'PetugasLab')
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-5">
        <h3 class="text-lg font-semibold mb-2">Menu Petugas Lab</h3>
        <p class="text-gray-600 mb-4">
            Silakan upload sertifikat hasil pengujian tanah:
        </p>
        <a href="{{ route('lab.lokasi.index') }}"
           class="inline-block px-4 py-2 bg-cyan-500 text-white rounded-lg hover:bg-cyan-600 transition">
            Cek Hasil & Upload Sertifikat
        </a>
    </div>
    @endif

    <!-- Teknisi -->
    @if(auth()->user()->role === 'TeknisiLapangan')
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-5">
        <h3 class="text-lg font-semibold mb-2">Menu Teknisi Lapangan</h3>
        <p class="text-gray-600 mb-4">
            Input data hasil uji sondir lapangan:
        </p>
        <a href="{{ route('teknisi.sondir.index') }}"
           class="inline-block px-4 py-2 bg-yellow-400 text-black rounded-lg hover:bg-yellow-500 transition">
            Input Hasil Sondir
        </a>
    </div>
    @endif

    <!-- Petugas Lapangan -->
    @if(auth()->user()->role === 'PetugasLapangan')
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-5">
        <h3 class="text-lg font-semibold mb-2">Menu Petugas Lapangan</h3>
        <p class="text-gray-600 mb-4">
            Cek jadwal pengajuan dan input lokasi berbasis GPS:
        </p>
        <a href="{{ route('lokasi.index') }}"
           class="inline-block px-4 py-2 bg-yellow-400 text-black rounded-lg hover:bg-yellow-500 transition">
            Cek Jadwal Pengajuan
        </a>
    </div>
    @endif

    <!-- Pemilik Rumah -->
    @if(auth()->user()->role === 'PemilikRumah')
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-5">
        <a href="{{ route('notifications.index') }}"
           class="inline-block px-4 py-2 bg-yellow-400 text-black rounded-lg hover:bg-yellow-500 transition">
            Lihat Notifikasi Kelayakan Fondasi
        </a>
    </div>
    @endif

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
            Logout
        </button>
    </form>

</div>

</body>
</html>