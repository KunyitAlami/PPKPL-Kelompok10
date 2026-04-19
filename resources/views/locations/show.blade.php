<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Lokasi Titik Uji</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-4xl mx-auto bg-white border rounded-xl shadow-sm p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">
            Detail Lokasi Titik Uji
        </h2>

        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
            Terarsip
        </span>
    </div>

    <!-- Info Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-gray-50 p-4 rounded-lg border">
            <p class="text-gray-500 text-xs uppercase font-semibold mb-1">
                Petugas Lab
            </p>
            <p class="text-gray-900 font-medium">
                {{ $location->petugasLab->nama }}
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border">
            <p class="text-gray-500 text-xs uppercase font-semibold mb-1">
                Koordinat
            </p>
            <p class="text-gray-900 font-medium">
                {{ $location->latitude }}, {{ $location->longitude }}
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border">
            <p class="text-gray-500 text-xs uppercase font-semibold mb-1">
                Tanggal Uji
            </p>
            <p class="text-gray-900 font-medium">
                {{ $location->tanggal_uji->format('d M Y') }}
            </p>
        </div>

    </div>

    <!-- Map -->
    <div id="map-show" class="h-96 w-full border rounded-lg mb-6"></div>

    <!-- Back -->
    <div>
        <a href="{{ route('lab.lokasi.index') }}" 
           class="text-blue-500 hover:underline text-sm">
            ← Kembali ke Daftar
        </a>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const lat = {{ $location->latitude ?? 0 }};
    const lng = {{ $location->longitude ?? 0 }};

    const map = L.map('map-show').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Titik Uji")
        .openPopup();

    setTimeout(() => {
        map.invalidateSize();
    }, 200);

});
</script>

</body>
</html>