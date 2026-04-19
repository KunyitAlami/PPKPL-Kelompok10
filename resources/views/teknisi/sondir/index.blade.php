<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pekerjaan Sondir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold">
            Daftar Pekerjaan Uji Sondir
        </h2>

        <a href="{{ route('dashboard') }}" 
           class="text-blue-500 text-sm hover:underline">
            ← Dashboard
        </a>
    </div>

    <!-- Success -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif


    <!-- ================= ANTREAN ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5 mb-6">
        <h3 class="text-red-500 font-semibold mb-4">
            ⏳ Antrean Uji Lapangan
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Proyek</th>
                        <th class="px-4 py-2">Koordinat</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($antrean as $jadwal)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $jadwal->id }}</td>

                            <td class="px-4 py-2">
                                {{ $jadwal->soilTest->proyek->nama_proyek ?? 'Proyek '.$jadwal->soilTest->proyek_id }}
                            </td>

                            <td class="px-4 py-2 text-xs text-gray-600">
                                {{ $jadwal->latitude }}, {{ $jadwal->longitude }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $jadwal->tanggal_uji->format('d M Y') }}
                            </td>

                            <td class="px-4 py-2">
                                <a href="{{ route('teknisi.sondir.create', $jadwal->id) }}"
                                   class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 text-xs">
                                    Input
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Belum ada jadwal uji lapangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- ================= RIWAYAT ================= -->
    <div class="bg-white border rounded-xl shadow-sm p-5">
        <h3 class="text-green-600 font-semibold mb-4">
            ✔ Riwayat Hasil Uji
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID Lokasi</th>
                        <th class="px-4 py-2">qc</th>
                        <th class="px-4 py-2">fs</th>
                        <th class="px-4 py-2">Indikator</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($riwayat as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">#{{ $r->lokasi_id }}</td>

                            <td class="px-4 py-2">
                                {{ $r->nilai_qc }} 
                                <span class="text-xs text-gray-500">kg/cm²</span>
                            </td>

                            <td class="px-4 py-2">
                                {{ $r->nilai_fs }} 
                                <span class="text-xs text-gray-500">kg/cm²</span>
                            </td>

                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded-lg bg-blue-100 text-blue-700">
                                    {{ $r->indikator_awal }}
                                </span>
                            </td>

                            <td class="px-4 py-2">
                                <form action="{{ route('teknisi.sondir.revert', $r->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin membatalkan hasil uji ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-red-500 text-xs hover:underline">
                                        ↺ Revert
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Belum ada riwayat uji.
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