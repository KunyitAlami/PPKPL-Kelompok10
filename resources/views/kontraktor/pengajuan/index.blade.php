<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pengajuan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6">

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold">Riwayat Pengajuan Uji Tanah</h2>

        <div class="space-x-2">
            <a href="{{ route('dashboard') }}"
               class="text-blue-500 hover:underline">
                ← Dashboard
            </a>

            <a href="{{ route('pengajuan.create') }}"
               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                + Buat Pengajuan
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Proyek</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tanggal</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($pengajuans as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">#{{ $p->id }}</td>
                        <td class="px-4 py-3">
                            Proyek ID: {{ $p->proyek_id }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $p->jenis_pengujian }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-lg bg-blue-100 text-blue-600">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            {{ $p->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-4 py-6 text-gray-500">
                            Belum ada data pengajuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

</body>
</html>