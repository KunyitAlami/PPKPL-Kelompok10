<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Lokasi Uji Tanah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold">Manajemen Lokasi Uji Tanah</h2>

        <a href="{{ route('dashboard') }}"
           class="text-blue-500 hover:underline text-sm">
            ← Dashboard
        </a>
    </div>

    <!-- Success -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif


    <!-- ================= BELUM ADA LOKASI ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-6">
        <h3 class="text-red-500 font-semibold mb-4">
            Pengajuan Belum Ada Lokasi
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Jenis</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($belum as $soilTest)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $soilTest->id }}</td>
                            <td class="px-4 py-2">{{ $soilTest->jenis_pengujian }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('lokasi.create', $soilTest->id) }}"
                                   class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-xs">
                                    Input Lokasi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                Semua pengajuan sudah punya lokasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- ================= SUDAH ADA LOKASI ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5">
        <h3 class="text-green-600 font-semibold mb-4">
            Pengajuan Sudah Ada Lokasi
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Jenis</th>
                        <th class="px-4 py-2">Kontraktor</th>
                        <th class="px-4 py-2">Petugas</th>
                        <th class="px-4 py-2">Latitude</th>
                        <th class="px-4 py-2">Longitude</th>
                        <th class="px-4 py-2">Tanggal</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($sudah as $soilTest)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $soilTest->id }}</td>
                            <td class="px-4 py-2">{{ $soilTest->jenis_pengujian }}</td>
                            <td class="px-4 py-2">{{ $soilTest->kontraktor_id }}</td>
                            <td class="px-4 py-2">{{ $soilTest->location->petugas_lapangan_id }}</td>
                            <td class="px-4 py-2">{{ $soilTest->location->latitude }}</td>
                            <td class="px-4 py-2">{{ $soilTest->location->longitude }}</td>
                            <td class="px-4 py-2">
                                {{ $soilTest->location->tanggal_uji->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">
                                Belum ada lokasi tersimpan
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