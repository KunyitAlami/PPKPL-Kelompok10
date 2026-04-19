<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Hasil Sondir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-xl mx-auto bg-white border rounded-xl shadow-sm p-6">

    <!-- Header -->
    <h2 class="text-xl font-bold mb-2">
        Input Hasil Sondir
    </h2>
    <p class="text-sm text-gray-600 mb-4">
        Lokasi ID #{{ $lokasi->id }}
    </p>

    <a href="{{ route('teknisi.sondir.index') }}"
       class="text-blue-500 text-sm hover:underline mb-4 inline-block">
        ← Kembali
    </a>

    <!-- Info Koordinat -->
    <div class="mb-5 p-4 bg-gray-50 border rounded-lg text-sm">
        <span class="font-medium">Koordinat:</span>
        {{ $lokasi->latitude }}, {{ $lokasi->longitude }}
    </div>

    <!-- Error -->
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
            Terdapat kesalahan pengisian, pastikan input berupa angka.
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('teknisi.sondir.store', $lokasi->id) }}" method="POST" class="space-y-4">
        @csrf

        <!-- QC -->
        <div>
            <label class="block text-sm font-medium mb-1">
                Nilai qc (kg/cm²)
            </label>
            <input 
                type="number" 
                step="any" 
                name="nilai_qc" 
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <p class="text-xs text-gray-500 mt-1">
                <20 (Lunak), 20–50 (Sedang), >50 (Keras)
            </p>
        </div>

        <!-- FS -->
        <div>
            <label class="block text-sm font-medium mb-1">
                Nilai fs (kg/cm²)
            </label>
            <input 
                type="number" 
                step="any" 
                name="nilai_fs" 
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Button -->
        <button 
            type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
            Simpan Hasil Sondir
        </button>

    </form>

</div>

</body>
</html>