<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Jadwal & Lokasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold">Manajemen Jadwal & Lokasi Uji</h2>

        <a href="{{ route('dashboard') }}" 
           class="text-blue-500 hover:underline text-sm">
            ← Dashboard
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif


    <!-- ================= ANTREAN ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-6">
        <h3 class="text-red-500 font-semibold mb-4">
            ⏳ Antrean Pengajuan
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Proyek</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($antrean as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $p->id }}</td>
                            <td class="px-4 py-2">
                                {{ $p->proyek->nama_proyek ?? 'Proyek '.$p->proyek_id }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('lab.lokasi.create', $p->id) }}"
                                   class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-xs">
                                    Set GPS
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                Tidak ada antrean.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- ================= SIAP UPLOAD ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-6">
        <h3 class="text-orange-500 font-semibold mb-4">
            📄 Siap Upload Sertifikat
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($siapUpload as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $p->id }}</td>
                            <td class="px-4 py-2">
                                {{ $p->location->latitude }}, {{ $p->location->longitude }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $p->location->tanggal_uji->format('d M Y') }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('lab.certificate.create', $p->id) }}"
                                   class="px-3 py-1 bg-orange-400 text-black rounded-lg hover:bg-orange-500 text-xs">
                                    Upload
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Belum ada data siap upload.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- ================= SELESAI ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5">
        <h3 class="text-green-600 font-semibold mb-4">
            ✔ Data Terverifikasi
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($selesai as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $p->id }}</td>
                            <td class="px-4 py-2">
                                {{ $p->location->latitude }}, {{ $p->location->longitude }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $p->location->tanggal_uji->format('d M Y') }}
                            </td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">
                                    ✔ Terverifikasi
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('lab.notify', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-xs">
                                        Kirim Notifikasi
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Belum ada data selesai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>